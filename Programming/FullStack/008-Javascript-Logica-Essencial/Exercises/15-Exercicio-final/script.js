let jobArray = [];
let jobObject = {};

function createNewObject(jobName, jobDescription, jobDatalimit) {
  jobName,
    jobDescription,
    jobDatalimit,
    (jobObject = { jName, jDescription, jDatalimit }),
    jobArray.push(jObject);
}

do {
  let userEntry = prompt(
    `Bem vindo ao sistema Job Finder!\nDigite alguma opção:\n1 - Listar vagas disponíveis\n2 - Criar uma nova vaga\n3 - Visualizar uma vaga\n4 - Inscrever um candidato em uma vaga\n5 - Inscrever um candidato em uma vaga\n6 - Sair`,
  );

  switch (userEntry) {
    case 1:
      if (jobArray == 0) {
        alert(`Sem vagas disponíveis no momento`);
      } else {
      }

      break;
    case 2:
      break;
    case 3:
      break;
    case 4:
      break;
    case 5:
      break;
    case 6:
      break;
  }
} while (userEntry != 6);
