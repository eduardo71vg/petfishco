docker-compose -f docker-compose.yml up -d

docker-compose run --rm -w /project app composer update

while true; do
     FILES=application/petfish.sql
     for f in ${FILES}
        do
            if [[ ! -e ${f} ]]; then continue; fi
            read -p "Do you want to import ${f} (y/n)?" yn2
            case ${yn2} in
                [Yy]* )
                echo "Copying file to docker container...."
                docker cp ${f} mysql:/tmp/tmp.sql
                echo "Executing sql script in docker container...."
                docker exec -i mysql mysql --user=root --password=secret --execute="USE phalcondb; SET autocommit=0; SET foreign_key_checks=0; source /tmp/tmp.sql; COMMIT; SET foreign_key_checks=1;"
                echo "Done! Make sure import was successful."
                # echo "Removing sql script ${f} copy..."
                # rm ${f}
                continue;;
                [Nn]* ) continue;;
            esac
        done
     break;
done

