<?php
function createVilleCheckboxes(selectedDepartement) {
    const villeCheckboxContainer = document.getElementById("villeCheckboxContainer");
    villeCheckboxContainer.innerHTML = "";  // Clear existing checkboxes
  
    // Récupérer les villes et compter le nombre de musées par ville dans le département sélectionné
    const museesDansDepartement = musees.filter(museum => museum.departement === selectedDepartement);
    const museesParVille = museesDansDepartement.reduce((acc, museum) => {
      acc[museum.ville] = (acc[museum.ville] || 0) + 1;
      return acc;
    }, {});
  
    // Créer des cases à cocher pour chaque ville
    Object.keys(museesParVille).forEach(ville => {
      const label = document.createElement("label");
      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      checkbox.value = ville;
      
      // Ajouter le nom de la ville et le nombre de musées
      label.appendChild(checkbox);
      label.appendChild(document.createTextNode(` ${ville} (${museesParVille[ville]} musée${museesParVille[ville] > 1 ? 's' : ''})`));
      
      villeCheckboxContainer.appendChild(label);
      villeCheckboxContainer.appendChild(document.createElement("br"));
  
      // Update map when checkbox changes
      checkbox.addEventListener('change', () => {
        const selectedVilles = Array.from(villeCheckboxContainer.querySelectorAll('input:checked')).map(cb => cb.value);
        updateMap(departementSelect.value, selectedVilles);
      });
    });
  }
  
  