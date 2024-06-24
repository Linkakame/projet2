document.addEventListener("DOMContentLoaded", function () {
    const louerButtons = document.querySelectorAll('.vehicule button');
    const modal = document.getElementById("myModal");
    const closeBtn = document.querySelector(".close");
    const vehicleDetailsContainer = document.getElementById("vehicleDetails");
    const vehiclePriceContainer = document.getElementById("vehiclePrice");
    const paymentButton = document.getElementById("payment-button");

    function afficherDetailsVehicule(nom, image, autonomie, tempsDeCharge, puissance, prix) {
        vehicleDetailsContainer.innerHTML = `
            <div>
                <p><strong>Nom :</strong> ${nom}</p>
                <p><strong>Autonomie :</strong> ${autonomie}</p>
                <p><strong>Temps de charge :</strong> ${tempsDeCharge}</p>
                <p><strong>Puissance :</strong> ${puissance}</p>
                <p><strong>Prix :</strong> ${prix}</p>
                <img src="${image}" alt="Image du véhicule">
            </div>
        `;
        vehiclePriceContainer.textContent = `Prix location : ${prix}`;
        modal.style.display = "block";
    }

    louerButtons.forEach(louerButton => {
        louerButton.addEventListener('click', function(event) {
            event.stopPropagation();

            const vehicule = louerButton.closest('.vehicule');
            const nom = vehicule.querySelector("#nom p").textContent;
            const image = vehicule.querySelector("#imagevehicule img").src;
            const autonomie = vehicule.querySelector("#Autonomie p").textContent;
            const tempsDeCharge = vehicule.querySelector("#Tempsdecharge p").textContent;
            const puissance = vehicule.querySelector("#Puissance p").textContent;
            const prix = vehicule.querySelector("#prix p").textContent;

            afficherDetailsVehicule(nom, image, autonomie, tempsDeCharge, puissance, prix);
        });
    });

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    paymentButton.addEventListener('click', function () {
        const vehicule = document.querySelector('.vehicule');
        const nom = vehicule.querySelector("#nom p").textContent;
        const image = vehicule.querySelector("#imagevehicule img").src;
        const autonomie = vehicule.querySelector("#Autonomie p").textContent;
        const tempsDeCharge = vehicule.querySelector("#Tempsdecharge p").textContent;
        const puissance = vehicule.querySelector("#Puissance p").textContent;
        const prix = vehicule.querySelector("#prix p").textContent;

        const vehiculeData = {
            nom: nom,
            image: image,
            autonomie: autonomie,
            tempsDeCharge: tempsDeCharge,
            puissance: puissance,
            prix: prix
        };

        const params = new URLSearchParams(vehiculeData).toString();
        window.location.href = `page_paiement.php?${params}`;
    });
});
