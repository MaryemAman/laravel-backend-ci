# ⚙️ Laravel Backend - CI/CD Ready

This is the backend of the full-stack CI/CD project built with **Laravel**. It includes Docker support and CI/CD automation via **Jenkins** and **GitHub**.

## 📁 Project Structure

<img width="447" height="1222" alt="image" src="https://github.com/user-attachments/assets/f36d91af-0e2b-4ee3-8c91-0b97167bee8c" />


## 💻 Local Development (Optional)

You can run Laravel locally using:

```bash
php artisan serve
```

Or use Docker Compose:

```bash
docker-compose up --build
```

Visit: http://localhost:9000

# 🐳 Docker Usage

Manual build:
```bash
docker build -t maryemaman/laravel-backend .
docker run -p 9000:9000 maryemaman/laravel-backend
```

# 🔁 CI/CD Pipeline (via Jenkins)

## On [localhost:8080](http://localhost:8080)
<img width="500" height="1000" alt="image" src="https://github.com/user-attachments/assets/d9e12ff6-d520-4f0d-bace-f822f77149a4" />

This repo includes a Jenkinsfile that:
- Builds a Docker image
- Logs into Docker Hub
- Pushes the image

Jenkinsfile Highlights
```bash
IMAGE_NAME = 'maryemaman/laravel-backend'
```

Jenkins should be configured with:
- Docker-in-Docker (DinD)
- Docker Hub credentials (dockerhub-credentials)

⚙️ Jenkins Setup Summary
```bash
docker run -d \
  --name jenkins \
  --network jenkins \
  -p 8080:8080 -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  jenkins/jenkins:lts
```

Run DinD:
```bash
docker run --privileged -d \
  --name dind \
  --network jenkins \
  -p 2375:2375 \
  -e DOCKER_TLS_CERTDIR="" \
  docker:dind \
  --host=tcp://0.0.0.0:2375 \
  --host=unix:///var/run/docker.sock
```
🧪 Manual Testing
After:
```bash
docker-compose up --build
```
Test backend at:

✅ http://localhost:9000

🔗 Git Commands
```bash
git add .
git commit -m "update"
git push origin main
```

---

📄 **Made by Maryem Mohamed**  
🔗 [GitHub Profile](https://github.com/MaryemAman)  
🚀 Powered by Docker, Jenkins, and GitHub CI/CD
