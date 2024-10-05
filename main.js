

function showMovie(movieName) {
  
  switch (movieName) {
    case 'AvengersInfinityWar':
      location.href = 'AvengersInfinityWar.html';
      break;
    case 'AvengersEndgame':
      location.href = 'AvengersEndgame.html';
      break;
    case '1920':
      location.href = '1920.html';
      break;
    case '1920EvilReturn':
      location.href = '1920EvilReturns.html';
      break;
    case 'Hereditary':
      location.href = 'Hereditary.html';
      break;
    default:
      alert("This movie is not available");
  }
}

