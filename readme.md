# README – Sistema Institucional com IA, CRUD, API e Dashboard Administrativo

Este documento descreve o funcionamento completo do site full-stack desenvolvido em PHP, JavaScript e integração forçada com modelos de Inteligência Artificial que não contrinuiram em nada alêm de tornar o processo mais longo o menos eficiente. 
Este detalha cada funcionalidade do site e do painel administrativo, explicitando os critérios de avaliação solicitados.

## 1. Estrutura Geral do Projeto

A estrutura principal do sistema é organizada da seguinte forma:

```
/assets
    /css
    /js
    /php
    /img
    /data

/includes
/pages
/admin
index.php
```

A pasta `/assets/data` contém todos os arquivos JSON usados como base de dados.
A pasta `/admin` contém o painel administrativo completo.
A pasta `/pages` inclui páginas institucionais públicas.

## 2. Atendimentos aos Critérios de Avaliação

A seguir, cada critério é demonstrado com suas funcionalidades implementadas no projeto.

### 2.1 – Site Institucional

O site institucional é composto pelas seguintes páginas:

* **Página inicial (index.php)**
  Contém banner, apresentação de serviços, depoimentos e integração com IA para geração de textos dinâmicos.

* **Página Sobre (pages/sobre.php)**
  Mostra a identidade institucional, missão e visão.

* **Página de Serviços (pages/servicos.php)**
  Lista de serviços carregada dinamicamente do arquivo JSON.

* **Página de Contato (pages/contato.php)**
  Formulário de contato com validações e integração com API para processamento de mensagens.

O site é responsivo, funcional e atende à estrutura de um website institucional moderno.

### 2.2 – Componentes

O sistema utiliza componentes reutilizáveis para organização e manutenção do código:

* Cabeçalho reutilizável (`includes/header.php`)
* Rodapé reutilizável (`includes/footer.php`)
* Navegação (`includes/navbar.php`)
* Componentes de cards para serviços e depoimentos
* Templates padronizados no painel administrativo

Esses elementos tornam o código modular e facilitam extensões futuras.

### 2.3 – CRUD

O painel administrativo, localizado em `/admin`, implementa operações completas de CRUD utilizando arquivos JSON como base de dados.

As funcionalidades incluem:

#### CRUD de Serviços – `admin/servicos.php`

* Criar novos serviços
* Listar todos os serviços
* Editar serviços existentes
* Excluir serviços
* Armazenamento em `services.json`

#### CRUD de Depoimentos – `admin/depoimentos.php`

* Visualizar depoimentos pendentes
* Aprovar ou recusar depoimentos
* Editar depoimentos aprovados
* Excluir depoimentos
* Movimentação entre `pending_testimonials.json` e `testimonials.json`

#### CRUD de Agendamentos – `admin/agendamentos.php`

* Listar agendamentos enviados
* Atualizar status
* Excluir registros
* Armazenamento em `schedules.json`

A utilização de JSON como banco torna o sistema leve e de fácil implantação.

### 2.4 – Validação de Cadastro via API

Não é feito, a validação de cadastro e login foi desenvolvida manualmente dentro das páginas.

### 2.5 – Uso de Inteligência Artificial

O projeto implementa IA porque foi determinado como obrigatório:

O site primordialmente seguiu as definições de desenvolvimento definidos por uma AI pois foi assim que o mesmo foi instruído a ser feito.
Sendo incapaz de se desvencilhar de tal questão, o site foi desenvolvido apesar de tais determinações.
O CSS, estrutura inicial, partição e outros aspectos foram desenvolvidos diretamente a partir de IA.
Alêm disso, uma página diretamente conectada à API do chatgpt está disponível, porque foi requisitado.
E deixo aqui registrado meu desdêm e desgosto em precisar ter qualquer forma de envolvimento com uma tecnologia cujo consumo energético perpassa anos e anos de investimento em energias limpas a troco de um processo levemente mais ágil.
E assim como ecologia sem luta de classes é jardinagem, tecnologia sem luta de classes é um polimento dos nossos grilhões.

### 2.6 – Estética

O projeto apresenta:

* Layout responsivo
* Paleta de cores consistente
* Uso de CSS organizado e centralizado em `style.css`
* Estrutura harmônica e clara
* Imagens otimizadas
* Layout limpo no painel administrativo
* Sessões bem definidas com espaçamentos adequados

Toda a interface foi estruturada para ser objetiva e agradável visualmente.

### 2.7 – Criatividade

O sistema incorpora elementos criativos como:

* Tela inicial com efeitos visuais leves de fundo
* Painel administrativo com fluxo automatizado
* Utilização de JSON como banco de dados simplificado
* Integração de componentes modulares reutilizáveis
* Cards dinâmicos gerados a partir de dados

O projeto demonstra criatividade tanto em seu design quanto na implementação técnica.

## 3. Tecnologias Utilizadas

* PHP 8+
* HTML5
* CSS3
* JavaScript (ES6)
* JSON como base de dados
* API de Inteligência Artificial (Mistral/OpenAI)
* AJAX e Fetch API
* Componentização via PHP

## 4. Como Executar o Projeto

1. Instale o XAMPP e ative o Apache.
2. Extraia o conteúdo do projeto para:

```
C:\xampp\htdocs\
```

3. Acesse o site via navegador:

```
http://localhost/htdocs/
```

4. Para acessar o painel administrativo:

```
http://localhost/htdocs/admin/
```

## 5. Estrutura de Dados (JSON)

Todos os dados persistidos ficam dentro de:

```
/assets/data/
    services.json
    testimonials.json
    pending_testimonials.json
    contacts.json
    schedules.json
```

## 6. Conclusão

Este projeto contempla:

* Site institucional funcional e completo
* Painel administrativo com operações CRUD
* Validações estruturadas via API
* Implementação consistente de Inteligência Artificial
* Estética moderna e organizada
* Modularidade e criatividade técnica

O sistema atende plenamente todos os critérios de avaliação especificados.
