FROM node:latest
RUN npm i -g nodemon
WORKDIR /app
COPY . .
RUN npm install
EXPOSE 5000
CMD [ "npm", "run", "dev" ]

# docker build -t app-name .