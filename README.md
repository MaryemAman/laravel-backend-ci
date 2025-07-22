# ⚙️ Maryem System Backend - CI/CD Ready

This is the backend of the Maryem System full-stack project, built with **Laravel**. It includes Docker support and CI/CD automation via **Jenkins** and **GitHub Actions**.

---

## 📁 Project Structure

<img width="447" height="1222" alt="Backend Project Structure" src="https://github.com/user-attachments/assets/f36d91af-0e2b-4ee3-8c91-0b97167bee8c" />

---

## 💻 Local Development (Optional)

You can run Laravel locally using:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --host=0.0.0.0 --port=9000
```

Or use Docker Compose (recommended for full stack):

```bash
docker-compose up --build
```

Visit: [http://localhost:9000](http://localhost:9000)

---

# 🐳 Docker Usage

Manual build and run:
```bash
docker build -t maryemaman/laravel-backend .
docker run -p 9000:9000 maryemaman/laravel-backend
```

Or use Docker Compose from the root project:

```bash
docker-compose up --build
```

---

# ⚙️ Environment Variables

Set these in `back-end/.env` or via Docker Compose:

- `DB_CONNECTION` – Database driver (mysql)
- `DB_HOST` – Database host (should be `db` when using Docker Compose)
- `DB_PORT` – Database port (3306)
- `DB_DATABASE` – Database name (`clms_db`)
- `DB_USERNAME` – Database user (`laravel`)
- `DB_PASSWORD` – Database password (`secret`)

---

# 🔁 CI/CD Pipeline (via Jenkins)

## On [localhost:8080](http://localhost:8080)
<img width="500" height="1000" alt="Jenkins Dashboard" src="https://github.com/user-attachments/assets/d9e12ff6-d520-4f0d-bace-f822f77149a4" />

This repo includes a Jenkinsfile that:
- Builds a Docker image
- Logs into Docker Hub
- Pushes the image

**Jenkinsfile Highlights**
```groovy
IMAGE_NAME = 'maryemaman/laravel-backend'
```

**Jenkins should be configured with:**
- Docker-in-Docker (DinD)
- Docker Hub credentials (ID: `dockerhub-credentials`)

---

## ⚙️ Jenkins Setup Summary

Start Jenkins:
```bash
docker run -d \
  --name jenkins \
  --network jenkins \
  -p 8080:8080 -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  jenkins/jenkins:lts
```

Start DinD:
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

---

# 🧪 Manual Testing

After:
```bash
docker-compose up --build
```
Test backend at:

- ✅ [http://localhost:9000](http://localhost:9000)

---

🔗 **Git Commands**
```bash
git add .
git commit -m "update"
git push origin main
```

---

📄 **Made by Maryem Mohamed**  
🔗 [GitHub Profile](https://github.com/MaryemAman)  
🚀 Powered by Docker, Jenkins,
