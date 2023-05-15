/*//NPM
-As vezes ocorre conflito por causa das versões
-Verificar versão: npm -v


//Criando projeto
Criar: npm init
Criar rápido: npm init --yes

//Configurar PACKAGE.json
-Alterando: npm config set init-author-name Albano
npm config set ini-author-email mario@gmail.com
npm config set ini-license MIT
-Pesquisar na documentação o que pode alterar

//Exibindos configurações
-npm get
-com as configurações, podemos usar e configurar algo específico

//Deletando configs
-npm config delete
-Ex: npm config delete author-init-url

//Instalar módulos global
-ex: npm install request -g

//Removendo módulos globais
-ex: npm uninstall request -g

//Listando módulos instalados
-npm list
-npm list -g --depth=0

//Limpando dependência não listadas
-npm prune
-Serve para não ter que dar uninstall em vários módulos

//Procurando módulos pelo terminal
-npm search nome_módulo

//Verificando se precisa atualizar algo
-npm outdated. Depois npm update

//Limpar cache
-verificar: npm cache verify
-limpando: npm cache clean --force

//Detectando falha de segurança nos módulos
-npm audit

//Corrigindo vulnerabilidade
-npm audit fix
-Se precisar: npm audit fix --force

//Conhecer pacotes
-npm view nome_modulo

//Documentação do pacote
-npm docs node_modulo
-npm home node_modulo

//Reduzindo duplicações
-Usado quando há duas dependencia com entradas diferentes.
-npm dedupe

//Não salvar no package.json
-npm install nome_modulo --no-save

//Scripts
-npm run nome_script
*/
