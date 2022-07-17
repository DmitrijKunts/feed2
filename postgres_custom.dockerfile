
FROM postgres:12

RUN apt-get update \
      && apt install postgresql-12-rum