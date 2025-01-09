import cv2
import pytesseract
from tkinter import Tk, filedialog
import re

# Cấu hình đường dẫn tới tesseract.exe
pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

# Bảng mã chữ cái chuẩn hóa
char_map = {
    'Đ': 'D', 'đ': 'd',
    'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'È': 'E', 'É': 'E', 'Ê': 'E', 'Ì': 'I', 'Í': 'I',
    'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ù': 'U', 'Ú': 'U', 'Ý': 'Y', 
    'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'è': 'e', 'é': 'e', 'ê': 'e', 'ì': 'i', 'í': 'i',
    'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ù': 'u', 'ú': 'u', 'ý': 'y',
    'Ă': 'A', 'ă': 'a', 'Đ': 'D', 'đ': 'd', 'Ĩ': 'I', 'ĩ': 'i', 'Ũ': 'U', 'ũ': 'u',
    'Ơ': 'O', 'ơ': 'o', 'Ư': 'U', 'ư': 'u', 'Ạ': 'A', 'ạ': 'a', 'Ả': 'A', 'ả': 'a',
    'Ấ': 'A', 'ấ': 'a', 'Ầ': 'A', 'ầ': 'a', 'Ẩ': 'A', 'ẩ': 'a', 'Ẫ': 'A', 'ẫ': 'a',
    'Ậ': 'A', 'ậ': 'a', 'Ắ': 'A', 'ắ': 'a', 'Ằ': 'A', 'ằ': 'a', 'Ẳ': 'A', 'ẳ': 'a',
    'Ẵ': 'A', 'ẵ': 'a', 'Ặ': 'A', 'ặ': 'a', 'Ẹ': 'E', 'ẹ': 'e', 'Ẻ': 'E', 'ẻ': 'e',
    'Ẽ': 'E', 'ẽ': 'e', 'Ế': 'E', 'ế': 'e', 'Ề': 'E', 'ề': 'e', 'Ể': 'E', 'ể': 'e',
    'Ễ': 'E', 'ễ': 'e', 'Ệ': 'E', 'ệ': 'e', 'Ỉ': 'I', 'ỉ': 'i', 'Ị': 'I', 'ị': 'i',
    'Ọ': 'O', 'ọ': 'o', 'Ỏ': 'O', 'ỏ': 'o', 'Ố': 'O', 'ố': 'o', 'Ồ': 'O', 'ồ': 'o',
    'Ổ': 'O', 'ổ': 'o', 'Ỗ': 'O', 'ỗ': 'o', 'Ộ': 'O', 'ộ': 'o', 'Ớ': 'O', 'ớ': 'o',
    'Ờ': 'O', 'ờ': 'o', 'Ở': 'O', 'ở': 'o', 'Ỡ': 'O', 'ỡ': 'o', 'Ợ': 'O', 'ợ': 'o',
    'Ụ': 'U', 'ụ': 'u', 'Ủ': 'U', 'ủ': 'u', 'Ứ': 'U', 'ứ': 'u', 'Ừ': 'U', 'ừ': 'u',
    'Ử': 'U', 'ử': 'u', 'Ữ': 'U', 'ữ': 'u', 'Ự': 'U', 'ự': 'u', 'Ỳ': 'Y', 'ỳ': 'y',
    'Ỵ': 'Y', 'ỵ': 'y', 'Ỷ': 'Y', 'ỷ': 'y', 'Ỹ': 'Y', 'ỹ': 'y'
}

# Hàm chuyển đổi văn bản về tiếng Anh không dấu
def convert_to_ascii(text):
    return ''.join(char_map.get(c, c) for c in text)

# Hàm chuẩn hóa văn bản và chuyển đổi về tiếng Anh không dấu
def normalize_text(text):
    return convert_to_ascii(text).replace('\n', ' ').replace('\r', '').strip()

# Hàm để đọc thông tin từ ảnh
def extract_info_from_image(image_path):
    # Đọc ảnh
    img = cv2.imread(image_path)
    
    # Sử dụng Tesseract OCR để trích xuất văn bản từ ảnh
    text = pytesseract.image_to_string(img)
    normalized_text = normalize_text(text)

    # Tìm tên sinh viên và niên khóa
    name_match = re.search(r'(Ho ten|Ho tén|Ten):?\s*(.*?)\s*(Ngay-sinh|Ngay sinh|Lop|Ngay sinh|Lop)', normalized_text, re.IGNORECASE)
    term_match = re.search(r'(\d{4})-(\d{4})', normalized_text)
    
    student_name = name_match.group(2) if name_match else "Khong tim thay ten"
    term = term_match.group(0) if term_match else "Khong tim thay nien khoa"

    return student_name, term

# Hàm để chọn tệp ảnh từ thư viện
def select_image():
    root = Tk()
    root.withdraw()  # Ẩn cửa sổ chính của Tkinter
    file_path = filedialog.askopenfilename(title="Chon anh", filetypes=[("Image Files", "*.png;*.jpg;*.jpeg")])
    return file_path

# Ví dụ sử dụng
image_path = select_image()

if image_path:
    student_name, term = extract_info_from_image(image_path)
    normalized_student_name = convert_to_ascii(student_name)
    print(f"Student Name: {student_name} -> {normalized_student_name}")
    print(f"Term: {term}")
else:
    print("Khong co anh duoc chon.")
