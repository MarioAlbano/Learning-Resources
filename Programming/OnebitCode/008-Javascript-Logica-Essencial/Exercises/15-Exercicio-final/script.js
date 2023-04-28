let jobArray = [];
let jobObject = {};

function createNewObject(jobName, jobDescription, jobDatalimit, jobEntry) {
  jobName,
    jobDescription,
    jobDatalimit,
    jobEntry,
    (jobObject = { jobName, jobDescription, jobDatalimit, jobEntry }),
    jobArray.push(jobObject);
}

createNewObject("111", "111", "111");
createNewObject("222", "222", "222");
console.log(jobArray);

for (i = 0; i <= jobArray.length; i++) {
  console.log(
    `índice:${jobArray.indexOf(jobArray[i] + 1)}, Nome:${jobArray[i].jobName}`,
  );
}

// do {
//   let userEntry = prompt(
//     `Bem vindo ao sistema Job Finder!\nDigite alguma opção:\n1 - Listar vagas disponíveis\n2 - Criar uma nova vaga\n3 - Visualizar uma vaga\n4 - Inscrever um candidato em uma vaga\n5 - Inscrever um candidato em uma vaga\n6 - Sair`,
//   );

//   switch (userEntry) {
//     case 1:
//       if (jobArray.length == 0) {
//         alert(`Sem vagas disponíveis no momento`);
//       } else {
//         for(i=0; i<=jobArray.length; i++){

//         }
//       }

//       break;
//     case 2:
//       break;
//     case 3:
//       break;
//     case 4:
//       break;
//     case 5:
//       break;
//     case 6:
//       break;
//   }
// } while (userEntry != 6);
