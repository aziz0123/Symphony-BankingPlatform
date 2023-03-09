// Récupération du bouton de tri et de la liste des packs
const sortByPriceBtn = document.querySelector('#sort-by-price-btn');
const packList = document.querySelector('#pack-list');

// Ajout d'un gestionnaire d'événements click sur le bouton de tri
sortByPriceBtn.addEventListener('click', () => {
  // Création d'un nouvel objet XMLHttpRequest
  const xhr = new XMLHttpRequest();

  // Configuration de la requête AJAX
  xhr.open('GET', '/api/packs?sort=price', true);

  // Gestionnaire d'événements pour la réponse AJAX
  xhr.onload = () => {
    // Vérification du statut de la réponse
    if (xhr.status === 200) {
      // Analyse des données JSON renvoyées
      const data = JSON.parse(xhr.responseText);

      // Mise à jour de la liste des packs sur la page HTML
      packList.innerHTML = '';
      data.forEach((pack) => {
        packList.innerHTML += `<div>${pack.name} - ${pack.prix}€</div>`;
      });
    } else {
      console.error('Une erreur est survenue lors de la requête AJAX');
    }
  };

  // Envoi de la requête AJAX
  xhr.send();
});
