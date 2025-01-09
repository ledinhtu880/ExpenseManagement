import cv2
import pytesseract
from tkinter import Tk, filedialog
import re
from datetime import datetime

# Cấu hình đường dẫn tới tesseract.exe
pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

# Hàm để đọc thông tin từ ảnh
def extract_info_from_image(image_path):
    # Đọc ảnh
    img = cv2.imread(image_path)
    
    # Sử dụng Tesseract OCR để trích xuất văn bản từ ảnh
    text = pytesseract.image_to_string(img)

    # In ra toàn bộ văn bản trích xuất để phân tích
    print("Extracted Text:", text)

    # Tìm tên sinh viên và niên khóa
    name_match = re.search(r"(?:Name|Ten|Ho ten|Ho tén|Student's Name)\s*[:\-\s]*([A-Z][a-zA-Z]+\s+[A-Z][a-zA-Z]+)", text, re.IGNORECASE)
    term_match = re.search(r'(\d{4})-(\d{4})', text)
    
    student_name = name_match.group(1).strip() if name_match else "Khong tim thay ten"
    term = term_match.group(0) if term_match else "Khong tim thay nien khoa"

    print(f"Extracted Student Name: {student_name}")
    print(f"Extracted Term: {term}")

    return student_name, term

# Hàm để kiểm tra tên sinh viên và niên khóa
def check_student_info(input_name, image_path):
    current_year = datetime.now().year
    student_name, term = extract_info_from_image(image_path)
    
    # Kiểm tra nếu tên sinh viên và niên khóa khớp với yêu cầu
    if input_name == student_name:
        start_year, end_year = map(int, term.split('-'))
        print(f"Start Year: {start_year}, End Year: {end_year}, Current Year: {current_year}")
        if start_year <= current_year <= end_year:
            return True
    
    print(f"Input Name: {input_name} vs Extracted Name: {student_name}")
    return False

# Hàm để chọn tệp ảnh từ thư viện
def select_image():
    root = Tk()
    root.withdraw()  # Ẩn cửa sổ chính của Tkinter
    file_path = filedialog.askopenfilename(title="Chon anh", filetypes=[("Image Files", "*.png;*.jpg;*.jpeg")])
    return file_path

# Ví dụ sử dụng
input_name = "ABDUL MATEEN"
image_path = select_image()

if image_path:
    result = check_student_info(input_name, image_path)
    print(f"Result: {result}")
else:
    print("Khong co anh duoc chon.")
