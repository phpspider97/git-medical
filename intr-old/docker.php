<?php
$array = [ 
    "what is Docker" => "Docker is a platform designed to make it easier to develop, deploy, and run applications using containers || Container, Image, Docker Engine, Docker Hub, Docker Compose, Dockerfile",
 
    "Install docker on mac" => "...",

    "What is Image and container" => "An image is a lightweight, standalone, and executable software package that includes everything needed to run a piece of software, including the code, runtime, libraries, and system tools. || A container is a runnable instance of a Docker image.",

    "What is docker hub and docker desktop" => "docker run -it image-name || docker container ls || docker container ls -a || docker start container-name || docker stop container-name || docker exec -it container-name bash ===> for permanent inside that container",

    "What is base image or parent image" => "node, reactjs and php etc is parent image",

    "Pull or download Image and run container" => "docker pull node || docker run node",

    "Make Basic Node js app" => "no need...",

    "Create docker file | make image from docker file" => "touch dockerfile",

    "Run Project with container" => "For random number add 0 in port",

    "Docker Ignore File" => ".dockerignore || *.extension for ignore all extension file",

    "Delete Images and Container with terminal" => "docker images || docker image rm image-name || docker image rm image-name -f {if it use or force delete} || for all container ===> docker ps -a || docker container rm container-name",

    "Manage Versions of images" => "docker build -t app-name:v1 . || For delete all container and images ===> docker system prune -a || docker run --name container-name -p 5500:5500 app-name:v1",

    "Volumes | update container with volume" => "npm i nodemon || volume command search in chat gpt",

    "Compose file" => "compose.yaml || docker compose up || search in chat gpt",

    "Share image on docker hub | push image on docker hub" => "...",

    "Upload Image on server" => "...",

    "Docker networking" => "docker network create -d bridge network-name || docker network inspect bridge || bridge, host, none",

    "Multi stage build" => "Make multiple step"
];


//https://gist.github.com/piyushgarg-dev/ea8c5aa52de0496753b88cd938abd728

include('bottom.php'); 