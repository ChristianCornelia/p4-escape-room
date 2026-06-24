document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const container = document.querySelector(".container");
    const reviewTitel = document.querySelector("h2");

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const naam = document.getElementById("naam").value.trim();
        const beoordeling = document.getElementById("beoordeling").value;
        const reviewTekst = document.getElementById("review").value.trim();

        if (!naam || !beoordeling || !reviewTekst) {
            alert("Vul alle velden in.");
            return;
        }

        const reviewDiv = document.createElement("div");
        reviewDiv.classList.add("review");

        reviewDiv.innerHTML = `
            <div class="name">${naam}</div>
            <div class="stars">${beoordeling.split(" ")[0]}</div>
            <p>${reviewTekst}</p>
        `;

        container.insertBefore(reviewDiv, reviewTitel);

        form.reset();
    });
});