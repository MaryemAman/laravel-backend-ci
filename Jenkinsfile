pipeline {
    agent any

    environment {
        DOCKERHUB_CREDENTIALS = 'dockerhub-credentials'  // Your Jenkins credentials ID
        DOCKERHUB_USERNAME = 'maryemaman'                 // Your Docker Hub username
        IMAGE_NAME = 'maryemaman/laravel-backend'  // your Docker Hub repo for backend image
        IMAGE_TAG = 'latest'                        // tag for the image, 'latest' is fine to start

    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Build Docker Image') {
            steps {
                script {
                    dockerImage = docker.build("${IMAGE_NAME}:${IMAGE_TAG}")
                }
            }
        }
        stage('Login to Docker Hub') {
            steps {
                script {
                    docker.withRegistry('', "${DOCKERHUB_CREDENTIALS}") {
                        echo 'Logged into Docker Hub'
                    }
                }
            }
        }
        stage('Push Docker Image') {
            steps {
                script {
                    docker.withRegistry('', "${DOCKERHUB_CREDENTIALS}") {
                        dockerImage.push()
                    }
                }
            }
        }
    }
}
