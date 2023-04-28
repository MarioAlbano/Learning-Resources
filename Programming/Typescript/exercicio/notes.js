//Javascript = Fracamente tipada. Typescript = Fortemente tipada. Typescript ajuda evitar bugs em um projeto grande

//Instalação: Visitar página oficial e usar 'npm install -g typescript'

//Typescript é compilado em Javascript. Para compilar usar 'tsc nome_do_arquivo.ts'

//Criar o tsconfig.json: 'tsc --init' e alterar a versão. Agora para compilar é só 'tsc'. Configurar o outDir para pasta build e o rootDir como pasta src

//Para testar, abrir um terminal dividido e usar 'node arquivo.js'Para não precisar sempre usar o tsc: 'tsc --watch'

//Examples: let variable: string = "string". let variable: number = 15. let userId: string | number = "1213". let number2: any = 12312. let estaAutenicado: boolean = true. let numeros: number[]. let filmes: string[]. let filmes: (string|number). let aluno: [string, number]. let newUser: object {name: "jones", email:"jones@gmail.com"}. enum StatusPermission{ADMIN, USER, SUPPORT}

//let statusAtual: unknown = 1.let mudaStatus: number = 0;
//mudaStatus = statusAtual as number.
