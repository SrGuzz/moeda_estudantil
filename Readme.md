[![Open in Visual Studio Code](https://classroom.github.com/assets/open-in-vscode-2e0aaae1b6195c2367325f4f02e2d04e9abb55f0b24a779b69b11b9e10269abc.svg)](https://classroom.github.com/online_ide?assignment_repo_id=99999999&assignment_repo_type=AssignmentRepo) [![Open in Codespaces](https://classroom.github.com/assets/launch-codespace-2972f46106e565e64193e422d61a12cf1da4916b45550586e14ef0a7c637dd04.svg)](https://classroom.github.com/open-in-codespaces?assignment_repo_id=99999999)

---

# 🏷️ Sistema de Moeda Estudantil ✨

- Breve descrição do projeto. **Foque no principal valor/benefício.**
- Crie uma **logo** para o projeto que represente a aplicação em questão.

<table>
  <tr>
    <td width="800px">
      <div align="justify">
        Este é um template/exemplo de <b>README.md</b> estruturado, criado para servir como um <b>modelo acadêmico e profissional</b> que os estudantes podem utilizar em seus projetos de desenvolvimento. Ele reúne as <i>seções essenciais</i> recomendadas pelo <a href="https://github.com/joaopauloaramuni">Prof. Dr. João Paulo Aramuni</a>, permitindo <i>organização clara</i>, <i>documentação eficiente</i> e <i>padronização</i> entre diferentes trabalhos. O objetivo deste esqueleto é <b>facilitar a construção de projetos bem documentados</b>, oferecendo um <i>guia completo</i> que inclui <b>boas práticas</b>, instruções de execução, tecnologias utilizadas, arquitetura, estruturas de pastas, testes, links úteis e orientações para colaboração. Esse template ajuda estudantes a desenvolverem <b>documentação de qualidade profissional</b> desde os primeiros períodos, promovendo <i>clareza</i>, <i>reprodutibilidade</i> e <i>padronização</i> nos projetos.
      </div>
    </td>
    <td>
      <div>
        <img src="https://joaopauloaramuni.github.io/image/logo_ES_vertical.png" alt="Logo do Projeto" width="120px"/>
      </div>
    </td>
  </tr> 
</table>

---

## 📚 Índice

- [Links Úteis](#-links-úteis)
- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades Principais](#-funcionalidades-principais)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Arquitetura](#-arquitetura)
  - [Exemplos de diagramas](#exemplos-de-diagramas)
- [Deploy](#-deploy)
- [Estrutura de Pastas](#-estrutura-de-pastas)
- [Demonstração](#-demonstração)
  - [Aplicativo Mobile](#-aplicativo-mobile)
  - [Aplicação Web](#-aplicação-web)
  - [Exemplo de saída no Terminal (para Back-end, API, CLI)](#-exemplo-de-saída-no-terminal-para-back-end-api-cli)
- [Testes](#-testes)
- [Documentações utilizadas](#-documentações-utilizadas)
- [Autores](#-autores)
- [Contribuição](#-contribuição)
- [Agradecimentos](#-agradecimentos)
- [Licença](#-licença)

---

## 🔗 Links Úteis

- 🌐 **Demo Online:** [Acesse a Aplicação Web](link-da-demo-web)
  > 💻 **Descrição:** Link para a aplicação em ambiente de produção (Ex: hospedado na Vercel, Netlify ou AWS S3).
- 📖 **Documentação:** [Leia a Wiki/Docs](docs)
  > 📚 **Descrição:** Acesso à documentação técnica completa do projeto (Ex: Swagger/OpenAPI para API, ou Wiki interna).

---

## 📝 Sobre o Projeto

- **Por que ele existe** — Esse sistema foi desenvolvido para a materia Laboratorio de Desenvolvimento de Software, do curso de Engenharia de Software da PUC-Minas.
- **Qual problema ele resolve** — Ele resolve um problema hipotético, no qual uma escola quer um sistema de moeda estudantil em que empresas possam participar e os alunos consigam resgatar. brindes e vantagens pelo sistema.
- **Qual o contexto** — acadêmico.
- **Onde ele pode ser utilizado** — Ele pode ser usado em escolas ou faculdades.

---

## ✨ Funcionalidades Principais

Liste as funcionalidades de forma clara e objetiva.

- 🔐 **Autenticação Segura:** Login, Cadastro e Recuperação de Senha.
- 📈 **Painel de Controle:** Visualização de dados em tempo real com gráficos.
- ⚙️ **Gerenciamento de CRUD:** Criação, Leitura, Atualização e Deleção de recursos (e.g., Usuários, Itens).

---

## 🛠 Tecnologias Utilizadas

\*TallStackUI.

### 💻 Front-end

- **Framework/Biblioteca:** Livewire
- **Linguagem/Superset:** PHP
- **Estilização:** Tailwind CSS
- **Build Tool:** Vite

### 🖥️ Back-end

- **Linguagem/Runtime:** PHP
- **Framework:** Laravel
- **Banco de Dados:** MySQL
- **ORM / Query Builder:** Composer
- **Autenticação:** Laravel Jetstream

---

## 🏗 Arquitetura

Descreva aqui a **arquitetura completa do sistema**, explicando como as camadas, módulos e componentes foram organizados. Informe também **por que** essa arquitetura foi escolhida e **quais problemas ela ajuda a resolver**.

Você pode incluir:

- **Visão geral da arquitetura** (ex.: camadas, módulos, microsserviços, monólito modular, hexagonal, MVC etc.)
- **Principais componentes** e o papel de cada um
- **Padrões de design adotados** (ex.: Repository, Service Layer, DTOs, Factory, Observer)
- **Fluxo de dados** entre as partes do sistema
- **Tecnologias utilizadas em cada camada**
- **Decisões arquiteturais importantes**
- **Trade-offs** ou limitações relevantes


---

### 🔑 Variáveis de Ambiente

Crie arquivos `.env` específicos e/ou configure as variáveis de ambiente no seu sistema para cada parte da aplicação.

#### 1 Back-end (Spring Boot)

Configure estas variáveis como **variáveis de ambiente do sistema** ou em um arquivo de configuração do Spring (ex: `application.properties`/`application.yml`).

| Variável | Descrição | Exemplo |
| :--- | :--- | :--- |
| `SERVER_PORT` | Porta onde o Back-end será executado. | `8080` |
| `SPRING_DATASOURCE_URL` | URL de conexão JDBC (PostgreSQL). | `jdbc:postgresql://localhost:5432/meubanco` |
| `SPRING_DATASOURCE_USERNAME` | Usuário do banco de dados. | `postgres` |
| `SPRING_DATASOURCE_PASSWORD` | Senha do banco de dados. | `senha-segura-123` |
| `JWT_SECRET` | Chave secreta para assinatura de tokens (Opcional). | `chave_super_segura_base64` |

#### 2 Front-end (React, Vite)

Crie um arquivo **`.env`** na raiz da pasta `/frontend` e use o prefixo `VITE_` (ou `REACT_APP_` se estiver usando CRA) para expor as variáveis ao *bundle* da aplicação.

| Variável | Descrição | Exemplo |
| :--- | :--- | :--- |
| `VITE_API_URL` | URL base do endpoint do Backend Spring Boot. | `http://localhost:8080/api` |
| `VITE_EMAILJS_PUBLIC_KEY` | Chave pública para serviços de e-mail (Exemplo). | `sua_public_key_aqui` |
| `VITE_GOOGLE_MAPS_KEY` | Chave de API para serviços de mapas (Opcional). | `AIzaSy...` |

---

#### 3. Exemplos de Variáveis de Ambiente na Vercel

A Vercel permite configurar variáveis no painel (Project Settings > Environment Variables).
Aqui estão exemplos comuns utilizadas em aplicações front-end e full-stack:

---


## 🎥 Demonstração

Use GIFs e prints para mostrar o projeto em ação.

Dê preferência a hospedar suas imagens em um **CDN** (Content Delivery Network) ou no **GitHub Pages** para garantir que elas carreguem rapidamente e não quebrem.

### 🌐 Aplicação Web

Para melhor visualização, as telas principais estão organizadas lado a lado.

|                                                                 Tela                                                                  |                                                           Captura de Tela                                                            |
| :-----------------------------------------------------------------------------------------------------------------------------------: | :----------------------------------------------------------------------------------------------------------------------------------: |
|                                                       **Página Inicial (Home)**                                                       |                                                         **Página de Login**                                                          |
| <img src="https://joaopauloaramuni.github.io/image/aramunilogo.png" alt="Tela Inicial da Aplicação Web" width="120px" height="120px"> |        <img src="https://joaopauloaramuni.github.io/image/aramunilogo.png" alt="Tela de Login" width="120px" height="120px">         |
|                                                       **Cadastro de Clientes**                                                        |                                                       **Cadastro de Produtos**                                                       |
| <img src="https://joaopauloaramuni.github.io/image/aramunilogo.png" alt="Tela de Cadastro de Clientes" width="120px" height="120px">  | <img src="https://joaopauloaramuni.github.io/image/aramunilogo.png" alt="Tela de Cadastro de Produtos" width="120px" height="120px"> |
|                                                      **Dashboard (Visão Geral)**                                                      |                                                   **Página Admin / Configurações**                                                   |
|       <img src="https://joaopauloaramuni.github.io/image/aramunilogo.png" alt="Tela de Dashboard" width="120px" height="120px">       |     <img src="https://joaopauloaramuni.github.io/image/aramunilogo.png" alt="Tela Administrativa" width="120px" height="120px">      |



---

| 👤 Nome                          | 🖼️ Foto                                                                                          | :octocat: GitHub                                                                                                                                                 | 💼 LinkedIn                                                                                                                                                                                               | 📤 Gmail                                                                                                                                                                  |
| -------------------------------- | ------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Davi Benjamim Guimarães**      | <div align="center"><img src="https://github.com/ArtMix532.png" width="70px" height="70px"></div> | <div align="center"><a href="https://github.com/ArtMix532"><img src="https://joaopauloaramuni.github.io/image/github6.png" width="50px" height="50px"></a></div> | <div align="center"><a href="https://www.linkedin.com/in/davi-benjamim-guimar%C3%A3es-b82741288/"><img src="https://joaopauloaramuni.github.io/image/linkedin2.png" width="50px" height="50px"></a></div> | <div align="center"><a href="mailto:davibenjamimguimaraes@gmail.com"><img src="https://joaopauloaramuni.github.io/image/gmail3.png" width="50px" height="50px"></a></div> |
| **Albert Luis Pereira de Jesus** | <div align="center"><img src="https://github.com/SrGuzz.png" width="70px" height="70px"></div>    | <div align="center"><a href="https://github.com/SrGuzz"><img src="https://joaopauloaramuni.github.io/image/github6.png" width="50px" height="50px"></a></div>    | <div align="center"><a href="https://www.linkedin.com/in/albert-luis/"><img src="https://joaopauloaramuni.github.io/image/linkedin2.png" width="50px" height="50px"></a></div>                            | <div align="center"><a href="mailto:albertlpjesus@gmail.com"><img src="https://joaopauloaramuni.github.io/image/gmail3.png" width="50px" height="50px"></a></div>         |

