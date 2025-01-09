import cv2
import pytesseract
import re
from datetime import datetime
import unidecode
import tkinter as tk
from tkinter import ttk
from tkinter import filedialog, messagebox
import os
from PIL import Image, ImageTk

class ImageGallery(tk.Frame):
    def __init__(self, parent, images_per_row=3, **kwargs):
        super().__init__(parent, **kwargs)
        self.images_per_row = images_per_row
        self.image_labels = []
        self.current_selection = None
        self.callbacks = []
        
    def load_images(self, folder_path):
        # Xóa ảnh cũ
        for label in self.image_labels:
            label.destroy()
        self.image_labels = []
        
        # Lấy danh sách file ảnh
        valid_extensions = ('.png', '.jpg', '.jpeg', '.bmp', '.gif')
        image_files = [f for f in os.listdir(folder_path) 
                      if f.lower().endswith(valid_extensions)]
        
        # Tạo thumbnail cho mỗi ảnh
        for idx, filename in enumerate(image_files):
            try:
                # Đường dẫn đầy đủ
                image_path = os.path.join(folder_path, filename)
                
                # Tạo thumbnail
                img = Image.open(image_path)
                img.thumbnail((150, 150))
                photo = ImageTk.PhotoImage(img)
                
                # Tạo label chứa ảnh
                label = ttk.Label(self, image=photo)
                label.image = photo  # Giữ reference
                label.filepath = image_path
                label.grid(row=idx // self.images_per_row,
                          column=idx % self.images_per_row,
                          padx=5, pady=5)
                
                # Binding click event
                label.bind('<Button-1>', self._on_click)
                
                self.image_labels.append(label)
                
            except Exception as e:
                print(f"Error loading {filename}: {e}")
                
    def _on_click(self, event):
        # Bỏ highlight ảnh cũ
        if self.current_selection:
            self.current_selection.configure(style='')
            
        # Highlight ảnh mới
        label = event.widget
        label.configure(style='Selected.TLabel')
        self.current_selection = label
        
        # Gọi callbacks
        for callback in self.callbacks:
            callback(label.filepath)
            
    def get_selected_image(self):
        return self.current_selection.filepath if self.current_selection else None
        
    def add_selection_callback(self, callback):
        self.callbacks.append(callback)

class StudentIDChecker(tk.Tk):
    def __init__(self):
        super().__init__()
        
        self.title("Student ID Checker")
        self.geometry("800x800")
        
        # Khởi tạo Tesseract
        pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'
        
        # Style cho selected image
        style = ttk.Style()
        style.configure('Selected.TLabel', borderwidth=2, relief='solid')
        
        self.create_widgets()
        
    def create_widgets(self):
        # Frame chính
        main_frame = ttk.Frame(self, padding="10")
        main_frame.grid(row=0, column=0, sticky=(tk.W, tk.E, tk.N, tk.S))
        
        # Input tên sinh viên
        ttk.Label(main_frame, text="Tên sinh viên:").grid(row=0, column=0, sticky=tk.W, pady=5)
        self.name_entry = ttk.Entry(main_frame, width=40)
        self.name_entry.grid(row=0, column=1, sticky=tk.W, pady=5)
        
        # Nút chọn thư mục
        ttk.Button(main_frame, text="Chọn thư mục ảnh", command=self.browse_folder).grid(row=1, column=0, columnspan=2, pady=5)
        
        # Gallery ảnh
        self.gallery = ImageGallery(main_frame, images_per_row=4)
        self.gallery.grid(row=2, column=0, columnspan=2, sticky=(tk.W, tk.E, tk.N, tk.S), pady=5)
        
        # Nút kiểm tra
        ttk.Button(main_frame, text="Kiểm tra", command=self.check_selected).grid(row=3, column=0, columnspan=2, pady=5)
        
        # Kết quả
        self.result_text = tk.Text(main_frame, height=10, width=60)
        self.result_text.grid(row=4, column=0, columnspan=2, pady=5)
        
    def browse_folder(self):
        folder_path = filedialog.askdirectory(title="Chọn thư mục chứa ảnh")
        if folder_path:
            self.gallery.load_images(folder_path)
    
    def normalize_vietnamese_name(self, name):
        normalized = unidecode.unidecode(name)
        normalized = ' '.join(normalized.upper().split())
        return normalized
    
    def check_student_id(self, image_path, input_name):
        try:
            normalized_input_name = self.normalize_vietnamese_name(input_name)
            
            img = cv2.imread(image_path)
            if img is None:
                raise Exception("Không thể đọc ảnh")
                
            gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
            thresh = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]
            
            text = pytesseract.image_to_string(thresh, lang='eng')
            
            name_patterns = [
                r'(?:Name|Họ và tên|Họ tên):\s*([^\n]+)',
                r'(?:Name|Họ và tên|Họ tên)\s*([^\n]+)',
            ]
            
            found_name = None
            for pattern in name_patterns:
                match = re.search(pattern, text, re.IGNORECASE)
                if match:
                    found_name = match.group(1).strip()
                    break
            
            if not found_name:
                raise Exception("Không tìm thấy tên trong thẻ sinh viên")
                
            normalized_found_name = self.normalize_vietnamese_name(found_name)
            name_matches = normalized_found_name == normalized_input_name
            
            year_patterns = [
                r'20\d{2}-20\d{2}',
                r'K\d{2}',
                r'Khoa \d{2}'
            ]
            
            start_year = None
            for pattern in year_patterns:
                match = re.search(pattern, text)
                if match:
                    year_text = match.group()
                    if 'K' in year_text:
                        start_year = 2000 + int(re.findall(r'\d+', year_text)[0])
                    else:
                        start_year = int(re.findall(r'20\d{2}', year_text)[0])
                    break
            
            if start_year is None:
                raise Exception("Không tìm thấy năm học")
                
            current_year = datetime.now().year
            is_active = current_year <= (start_year + 4)
            
            return {
                'success': True,
                'name_matches': name_matches,
                'is_active': is_active,
                'found_name': found_name,
                'normalized_found_name': normalized_found_name,
                'normalized_input_name': normalized_input_name
            }
            
        except Exception as e:
            return {
                'success': False,
                'error': str(e)
            }
    
    def check_selected(self):
        selected_image = self.gallery.get_selected_image()
        if not selected_image:
            messagebox.showwarning("Cảnh báo", "Vui lòng chọn một ảnh để kiểm tra")
            return
            
        input_name = self.name_entry.get().strip()
        if not input_name:
            messagebox.showwarning("Cảnh báo", "Vui lòng nhập tên sinh viên")
            return
        
        # Kiểm tra
        result = self.check_student_id(selected_image, input_name)
        
        # Hiển thị kết quả
        self.result_text.delete(1.0, tk.END)
        
        if result['success']:
            self.result_text.insert(tk.END, "Kết quả kiểm tra:\n\n")
            self.result_text.insert(tk.END, f"Tên tìm thấy: {result['found_name']}\n")
            self.result_text.insert(tk.END, f"Tên đã chuẩn hóa từ ảnh: {result['normalized_found_name']}\n")
            self.result_text.insert(tk.END, f"Tên người dùng đã chuẩn hóa: {result['normalized_input_name']}\n")
            self.result_text.insert(tk.END, f"Tên khớp: {'✓' if result['name_matches'] else '✗'}\n")
            self.result_text.insert(tk.END, f"Thẻ còn hiệu lực: {'✓' if result['is_active'] else '✗'}\n\n")
            
            if result['name_matches'] and result['is_active']:
                self.result_text.insert(tk.END, "Kết luận: Thẻ sinh viên hợp lệ ✓\n")
            else:
                self.result_text.insert(tk.END, "Kết luận: Thẻ sinh viên không hợp lệ ✗\n")
        else:
            self.result_text.insert(tk.END, f"Lỗi: {result['error']}\n")

if __name__ == "__main__":
    app = StudentIDChecker()
    app.mainloop()