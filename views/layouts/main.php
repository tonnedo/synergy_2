<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карусель</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: 'Roboto', sans-serif;
        }

        .carousel {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-container {
            width: 500px;
            height: 300px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 20px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .nav-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .nav-button:focus {
            outline: none;
        }

        .image-counter {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="carousel">
    <button id="prev" class="nav-button">Назад</button>
    <div class="image-container">
        <img id="carousel-image" src="images/image1.jpg" alt="Image 1">
    </div>
    <button id="next" class="nav-button">Вперед</button>
</div>
<div class="image-counter" id="image-counter">Изображение 1 из 3</div>

<script>
    const images = ['images/image1.jpg', 'images/image2.jpg', 'images/image3.jpg'];
    let currentIndex = 0;

    const imageElement = document.getElementById('carousel-image');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const counterElement = document.getElementById('image-counter');

    function updateImage() {
        imageElement.src = images[currentIndex];
        counterElement.textContent = `Изображение ${currentIndex + 1} из ${images.length}`;
    }

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    });

    // Initial image setup
    updateImage();
</script>
</body>
</html>