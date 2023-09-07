# 🙋‍ Elaboração de aplicação integrada a um banco de dados

Este repositório apresenta o processo para a elaboração da aplicação web integrada a um banco de dados. A aplicação não contempla um front-end, apenas php/html puro, com uma tabela que apresenta e armazena os valores em um banco de dados. 

## Pré-requisitos
Antes de iniciar, certifique-se que possuí a seguinte instação:

1. Putty: [Putty.org](putty.org)
2. Conta na AWS

## Banco de Dados

Usamos o banco de dados MySQL para armazenar informações sobre usuários. A Tabela "Employees" possui os seguintes campos:
1. ID
2. Name
3. Adress
4. 
Sendo ID o número de identificação na tabela; Name o nome do usuário e Adress o endereço do usuário.

Já a Tabela "Feriadão" possui os seguintes campos:
1. ID
2. Name
3. Local
Sendo ID o número de identificação na tabela; Name podemos classificar como o feriado em questão (por exemplo, 07 de Setembro) e, Local sendo a cidade/Estado/País em que você irá passar tal feriado descrito em "Name"

## Ferramentas

1. RDS
   
   O Amazon RDS (Relational Database Service) é um serviço de banco de dados gerenciado pela AWS que simplifica a configuração, operação e escalabilidade de bancos de dados relacionais na nuvem.

2. EC2

   A Amazon Elastic Compute Cloud (EC2) é um serviço de computação em nuvem da AWS que oferece instâncias virtuais escaláveis para executar aplicativos e cargas de trabalho na nuvem.
