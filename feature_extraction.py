import os
import face_recognition

dirListing = os.listdir("faces")
known_face_names = []
known_face_encodings = []
for item in dirListing:
        path="faces/"+item
        known_face_encodings.append(face_recognition.face_encodings(face_recognition.load_image_file(path))[0])
        known_face_names.append(item.strip("[.jpg]"))
print("feature extraction processed successfully")
