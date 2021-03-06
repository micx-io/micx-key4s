FROM nfra/kickstart-flavor-php:unstable
ENV DEV_CONTAINER_NAME="your-project-name"
ENV DATA_PATH="/data"

ADD / /opt
RUN ["bash", "-c",  "chown -R user /opt"]
RUN ["/kickstart/run/entrypoint.sh", "build"]

ENTRYPOINT ["/kickstart/run/entrypoint.sh", "standalone"]
