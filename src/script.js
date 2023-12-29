const categorie = {
    'Ortofrutta': {
        'Mela': 1.50, 'Banana': 0.80, 'Arancia': 1.20, 'Uva': 2.00, 'Fragola': 2.50,
        'Carota': 0.60, 'Pomodoro': 1.00, 'Zucchina': 1.20, 'Peperone': 1.30, 'Insalata': 1.80
    },
    'Carne': {
        'Pollo': 5.00, 'Manzo': 8.50, 'Maiale': 6.00, 'Agnello': 10.00, 'Vitello': 9.00,
        'Salsiccia': 4.50, 'Prosciutto': 7.20, 'Salame': 6.80, 'Filetto': 12.50, 'Cotechino': 5.50
    },
    'Pesce': {
        'Salmone': 9.50, 'Tonno': 8.00, 'Branzino': 11.00, 'Merluzzo': 7.50, 'Acciuga': 5.80,
        'Gamberetto': 12.00, 'Calamaro': 6.50, 'Orata': 10.50, 'Spigola': 11.20, 'Sogliola': 8.80
    },
    'Prodotti_Freschi': {
        'Latte': 1.80, 'Uova': 2.50, 'Formaggio': 3.50, 'Yogurt': 1.20, 'Panna': 1.50,
        'Burro': 2.00, 'Pane': 1.00, 'Pasta Fresca': 2.50, 'Salsa Fresca': 2.80, 'Insalata Pronta': 3.00
    },
    'Surgelati': {
        'Pizza': 4.50, 'Gelato': 3.00, 'Verdura Surgelata': 2.20, 'Pesce Surgelato': 6.80,
        'Pollo Surgelato': 5.50, 'Patatine': 2.00, 'Hamburger Surgelati': 4.00, 'Frutta Surgelata': 3.50,
        'Lasagna Surgelata': 7.50, 'Pasticcio Surgelato': 6.00
    }
};


const selectElement = document.getElementById('prodotti');
const quantitaElement = document.getElementById('quantita');
const singoloElement = document.getElementById('prezzoSingolo');
const totaleElement = document.getElementById('prezzoTotale');
const categoriaElement = document.getElementById('categoria');


selectElement.addEventListener('change', e => {
    // Ottieni il valore selezionato
    let selectedValue = selectElement.value;

    // Cerca il prodotto in tutte le categorie
    for (let categoria in categorie) {
        if (categorie[categoria].hasOwnProperty(selectedValue)) {
            // Se il prodotto è trovato, ottieni il prezzo e la categoria
            const prezzo = categorie[categoria][selectedValue];

            // Stampa il prezzo e la categoria nella console
            singoloElement.value = prezzo + "€";
            totaleElement.value = prezzo * quantitaElement.value + "€";
            categoriaElement.value = categoria.replace("_", " ");
            break; // Esci dal ciclo una volta che il prodotto è stato trovato
        }
    }

});


quantitaElement.addEventListener('change', e => {
    // Ottieni il valore selezionato
    let selectedValue = selectElement.value;

    // Stampa il valore nella console
    for (let categoria in categorie) {
        if (categorie[categoria].hasOwnProperty(selectedValue)) {
            // Se il prodotto è trovato, ottieni il prezzo e la categoria
            const prezzo = categorie[categoria][selectedValue];

            // Stampa il prezzo e la categoria nella console
            singoloElement.value = prezzo + "€";
            totaleElement.value = prezzo * quantitaElement.value + "€";
            categoriaElement.value = categoria.replace("_", " ");
            break; // Esci dal ciclo una volta che il prodotto è stato trovato
        }
    }
});

document.addEventListener('DOMContentLoaded', e => {
    let selectedValue = selectElement.value;

// Stampa il valore nella console
    for (let categoria in categorie) {
        if (categorie[categoria].hasOwnProperty(selectedValue)) {
            // Se il prodotto è trovato, ottieni il prezzo e la categoria
            const prezzo = categorie[categoria][selectedValue];

            // Stampa il prezzo e la categoria nella console
            singoloElement.value = prezzo + "€";
            totaleElement.value = prezzo * quantitaElement.value + "€";
            categoriaElement.value = categoria.replace("_", " ");
            break; // Esci dal ciclo una volta che il prodotto è stato trovato
        }
    }
});