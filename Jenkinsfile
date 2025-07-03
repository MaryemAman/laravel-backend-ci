// pipeline {
//     agent any

//     environment {
//         DOCKER_HOST = 'tcp://dind:2375'  // Connects to Docker-in-Docker container on the 'jenkins' network
//         DOCKERHUB_CREDENTIALS = 'dockerhub-credentials'
//         DOCKERHUB_USERNAME = 'maryemaman'
//         IMAGE_NAME = 'maryemaman/laravel-backend'
//         IMAGE_TAG = 'latest'
//     }


//     stages {
//         stage('Checkout') {
//             steps {
//                 checkout scm
//             }
//         }
//         stage('Build Docker Image') {
//             steps {
//                 script {
//                     dockerImage = docker.build("${IMAGE_NAME}:${IMAGE_TAG}")
//                 }
//             }
//         }
//         stage('Login to Docker Hub') {
//             steps {
//                 script {
//                     docker.withRegistry('', "${DOCKERHUB_CREDENTIALS}") {
//                         echo 'Logged into Docker Hub'
//                     }
//                 }
//             }
//         }
//         stage('Push Docker Image') {
//             steps {
//                 script {
//                     docker.withRegistry('', "${DOCKERHUB_CREDENTIALS}") {
//                         dockerImage.push()
//                     }
//                 }
//             }
//         }
//     }
// }


pipeline {
    agent {
        docker {
            image 'docker:24.0.6-cli' // lightweight Docker CLI-only image
            args '-v /var/run/docker.sock:/var/run/docker.sock' // optional if you use socket; not needed if using tcp://dind
        }
    }

    environment {
        DOCKER_HOST = 'tcp://dind:2375'  // talk to your DinD container
        DOCKERHUB_CREDENTIALS = 'dockerhub-credentials'
        DOCKERHUB_USERNAME = 'maryemaman'
        IMAGE_NAME = 'maryemaman/laravel-backend'
        IMAGE_TAG = 'latest'
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
                    sh 'docker version' // debug: confirm docker is accessible
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
