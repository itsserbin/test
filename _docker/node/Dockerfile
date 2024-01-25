# этап сборки (build stage)
FROM node:20
ENV APP_ROOT /var/www/frontend
WORKDIR ${APP_ROOT}

COPY frontend/package*.json ./
RUN npm install
COPY . .

CMD ["npm", "run", "dev"]
#
## этап сборки (build stage)
#FROM develop-stage as build-stage
#RUN npm run build
#
## этап production (production-stage)
#FROM build-stage as production-stage
#EXPOSE 3000
#CMD ["npm", "run", "start"]