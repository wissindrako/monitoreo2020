// // Creamos las variables para obtener la canitdad correspondiente a cada una.
// const getRemainTime = deadline => {
//   let now = new Date(),
//   remainTime = (new Date(deadline) - now + 1000) / 1000,
//   remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
//   remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2),
//   remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
//   remainDays = Math.floor(remainTime / (3600 * 24));
//   // Las retornamos a dichas variables
//   return {
//       RemainTime,
// remainSeconds,
// remainMinutes,
// remainHours,
// remainDays
//   }
// };
// // Creamos el contador
// const countdown = (deadline, elem, finalMessage) => {
//   // Aqui la variable "elem" es donde vamos a guardar el contenido del contador el cual al final de todo en countdown se le pone el verdadero id "clock" del HTML.
//   const el = document.getElementById(elem);
//   const timerUpdate = setInterval( () => {
//       let t = getRemainTime(deadline);
//       // Aqui insertamos las variables en el <h3 id="clock"></h3>
//       el.innerHTML = `${t.remainDays}d:${t.remainHours}h:${t.remainMinutes}m:${t.remainSeconds}s`;
//       // Aca limpiamos el contador cuando llega a cero
//       if (t.remainTime <= 1) {
//           clearInterval(timerUpdate);
//           el.innerHTML = finalMessage;
//       }
//   }, 1000);
// };
// // Y por ultimo, en este formato SIN MODFIFICARLO, le pones las fecha que quieras, pero sin modificar el formato. Puede ser 'Oct 16 2018 15:20:51 GMT-0500', 'clock', 'El Mensajes que quieras puede aparecer aquúi'
// Countdown('Sep 20 2020 10:32:53 GMT-0500', 'clock', 'Feliz 2020');

// <!-- Display the countdown timer in an element -->
// <p id="demo"></p>
