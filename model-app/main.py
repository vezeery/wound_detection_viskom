from fastapi import FastAPI, File, UploadFile, HTTPException
from ultralytics import YOLO
import shutil
import uuid
import os

app = FastAPI()

model = YOLO("best.pt")

ALLOWED_EXTENSIONS = ["jpg", "jpeg", "png", "webp"]

@app.get("/")
def home():
    return {
        "message": "API Running"
    }

@app.post("/predict")
async def predict(file: UploadFile = File(...)):

    ext = file.filename.split(".")[-1].lower()

    if ext not in ALLOWED_EXTENSIONS:
        raise HTTPException(
            status_code=400,
            detail="Invalid image format"
        )

    temp_filename = f"{uuid.uuid4()}.{ext}"

    try:

        with open(temp_filename, "wb") as buffer:
            shutil.copyfileobj(file.file, buffer)

        results = model.predict(
            source=temp_filename,
            imgsz=224
        )

        probs = results[0].probs

        class_id = probs.top1
        confidence = float(probs.top1conf)

        class_name = results[0].names[class_id]

        return {
            "status": "success",
            "class": class_name,
            "confidence": round(confidence, 4)
        }

    except Exception as e:

        raise HTTPException(
            status_code=500,
            detail=str(e)
        )

    finally:

        if os.path.exists(temp_filename):
            os.remove(temp_filename)