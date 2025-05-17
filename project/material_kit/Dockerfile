FROM node:18

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH
ENV NODE_ENV=development
ENV CHOKIDAR_USEPOLLING=true

COPY package.json yarn.lock ./

RUN npm install --silent

COPY . .

# Para desenvolvimento (hot reload)
EXPOSE 3000
CMD ["npm", "run", "dev"]

# Para produção (descomente abaixo e comente as linhas acima)
# RUN npm run build
# EXPOSE 3000
# CMD ["npm", "start"]
