Ontem foi dia de um pouco de estudo com meus amigos Edson Ferreira da Silva, Jabez Bornholdo, Ícaro Milet, Herbert de Gusmão Tenório, Danilo Barros de França, Luís Ribeiro e Wellington Ribeiro

Estamos criando uma API em .NET 6, utilizando de boas práticas para a escrita de código e com uma stack bem legal.

.NET 6 - (com rate limit, correlation id (todos serão implementados como middleware))
EF Core - nosso ORM para persistência
Postgres - nosso db
ELK - nossa observabilidade (log, trace e métricas)
Redis (essa eu pensei agora e vou colocar) - para cache
SonarQube - para fazer analise do código
Github Actions - para fazer o build, criar a imagem do projeto e disponibilizar no hub.docker

ah, tbm estamos utilizando o padrão de commits: Conventional Commits. Isso é muito importante!

Vamos usar kong e konga para administrar nossos endpoints
Criamos um docker-compose com a stack da infra: ELK (com 3 servidores de LogStash) , Postgres com pgAdmin, SonarQube. Ah e rodando tudo no WSL 2

Talvez ainda algumas outras coisas entrem para fazer parte da nossa stack de tecnologias utilizadas no projeto para estudo. Esta sendo bem massa

E vc, esta estudando o que?
Convide seus amigos para fazer um projeto. Se desafie. Aprenda. E compartilhe conhecimento!

Link do repositório: https://lnkd.in/eU28mAee

Quem quiser, segue o perfil no github que sempre tem coisa nova
https://lnkd.in/eDxXR_4q

#github #docker #dotnet #elk #elkstack #sonarqube #redis #postgresql #postgres #githubactions



https://www.linkedin.com/feed/update/urn:li:activity:6940823101035139072/