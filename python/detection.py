import cv2
import pytesseract
import re
from datetime import datetime
from tkinter import Tk, filedialog
import os

pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

def select_image():
    root = Tk()
    root.withdraw()  # Hide main window
    
    filetypes = [
        ('Image files', '*.jpg *.jpeg *.png *.bmp *.gif'),
    ]
    
    file_path = filedialog.askopenfilename(
        title='Select Student ID Image',
        filetypes=filetypes
    )
    
    return file_path if file_path else None

def check_student_status(image_path):
    try:
        img = cv2.imread(image_path)
        if img is None:
            raise Exception("Could not read image")
            
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        thresh = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]
        
        text = pytesseract.image_to_string(thresh, lang='eng')
        print("Extracted text:", text)
        
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
            raise Exception("Could not find academic year")
            
        current_year = datetime.now().year
        return current_year <= (start_year + 4)
        
    except Exception as e:
        print(f"Error processing image: {str(e)}")
        return False

if __name__ == "__main__":
    image_path = select_image()
    if image_path:
        result = check_student_status(image_path)
        print(f"Student is currently enrolled: {result}")
    else:
        print("No image selected")