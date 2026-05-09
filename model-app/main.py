from fastapi import FastAPI, File, UploadFile
from ultralytics import YOLO
import shutil

app = FastAPI()

@app.get("/")
def home():
    return {"message": "API Running"}

model = YOLO("best.pt")

@app.post("/predict")
async def predict(file: UploadFile = File(...)):

    file_path = f"temp_{file.filename}"

    with open(file_path, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)

    results = model.predict(source=file_path, imgsz=224)

    probs = results[0].probs

    class_id = probs.top1
    confidence = float(probs.top1conf)

    class_name = results[0].names[class_id]

    return {
        "class": class_name,
        "confidence": confidence
    }
