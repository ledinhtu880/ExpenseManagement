import cv2
import pytesseract
from tkinter import Tk, filedialog
import re
from datetime import datetime

# Configure Tesseract path
pytesseract.pytesseract.tesseract_cmd = r'/usr/bin/tesseract'

def extract_info_from_image(image_path):
    # Read image
    img_cv = cv2.imread(image_path)
    img = cv2.cvtColor(img_cv, cv2.COLOR_BGR2RGB)
    
    # Improve image quality for text extraction
    img = cv2.resize(img, None, fx=2, fy=2)  # Upscale
    img = cv2.GaussianBlur(img, (3,3), 0)  # Reduce noise
    
    # Extract text using Tesseract with Vietnamese language
    text = pytesseract.image_to_string(img, lang="vie")
    print("Extracted Text:", text)

    # Simpler name pattern that works with Vietnamese text
    name_pattern = r"Họ tên:\s*([^\n]+)"
    name_match = re.search(name_pattern, text)
    
    # Extract term with simpler pattern
    term_pattern = r"Khóa học:\s*(\d{4})-(\d{4})"
    term_match = re.search(term_pattern, text)

    # Process matches with better error handling
    student_name = "Khong tim thay ten"
    term = "Khong tim thay nien khoa"
    
    if name_match:
        extracted_name = name_match.group(1).strip()
        if extracted_name:  # Make sure we got a non-empty string
            student_name = extracted_name
            
    if term_match:
        start_year = term_match.group(1)
        end_year = term_match.group(2)
        if start_year and end_year:  # Make sure both years were found
            term = f"{start_year}-{end_year}"

    print(f"Extracted Student Name: {student_name}")
    print(f"Extracted Term: {term}")

    return student_name, term

def check_student_info(input_name, image_path):
    current_year = datetime.now().year
    student_name, term = extract_info_from_image(image_path)

    # Normalize strings for comparison (remove extra spaces)
    input_name = ' '.join(input_name.split())
    extracted_name = ' '.join(student_name.split())
    
    print(f"Comparing names:")
    print(f"Input name (normalized): '{input_name}'")
    print(f"Extracted name (normalized): '{extracted_name}'")
    
    name_matches = input_name == extracted_name
    
    if name_matches and term != "Khong tim thay nien khoa":
        try:
            start_year, end_year = map(int, term.split("-"))
            print(f"Start Year: {start_year}, End Year: {end_year}, Current Year: {current_year}")
            return start_year <= current_year <= end_year
        except ValueError:
            print("Error parsing years from term")
            return False
    
    return False

def select_image():
    root = Tk()
    root.withdraw()
    file_path = filedialog.askopenfilename(
        title="Chon anh",
        filetypes=[("Image Files", "*.png;*.jpg;*.jpeg")]
    )
    return file_path

if __name__ == "__main__":
    input_name = "Đoàn Phương Hà"
    image_path = select_image()

    if image_path:
        result = check_student_info(input_name, image_path)
        print(f"Result: {result}")
    else:
        print("Khong co anh duoc chon.")