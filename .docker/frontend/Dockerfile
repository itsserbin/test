FROM node:20-alpine
ENV APP_ROOT /usr/app
WORKDIR ${APP_ROOT}

COPY frontend/package*.json ./
#COPY frontend/package-lock*.json ${APP_ROOT}
#RUN npm config set registry http://registry.npmjs.org/
#RUN npm i
RUN npm ci && npm cache clean --force
COPY . .

CMD ["npm", "run", "build"]