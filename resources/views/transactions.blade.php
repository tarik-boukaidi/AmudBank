@extends('client')

@section('styles')
<style>
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --light-color: #ecf0f1;
    --dark-color: #2c3e50;
    --success-color: #2ecc71;
}

.section-title {
    font-size: 22px;
    margin-bottom: 20px;
    color: var(--primary-color);
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 10px;
}

.btn {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 14px;
}

.btn-primary {
    background-color: var(--secondary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.transfer-form {

}

.transfer-form h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
    font-size: 20px;
}

.transfer-form label {
    font-weight: 500;
    display: block;
    margin-top: 15px;
}

.transfer-form input, 
.transfer-form select, 
.transfer-form textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.transfer-form button {
    margin-top: 20px;
    width: 100%;
}
</style>
@endsection

@section('content')
<form class="transfer-form" method="POST" action="{{ route('faireTransactions') }}">
@csrf
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h3><i class="fas fa-paper-plane"></i> Virement Bancaire</h3>
    <p>Veuillez fournir les détails ou les notes spécifiques liés au virement.</p>

    <h4>Détails du Virement</h4>
    <p>Entrez votre informations de virement. </p>

    <label for="source">Sélectionner la Banque Source</label>
    <select id="source" name="source" required>
        <option value="">-- Sélectionner la banque --</option>
        <option value="courant">Compte Courant</option>
        <option value="epargne">Compte Épargne</option>
        <option value="professionnel">Compte Professionnel</option>
    </select>
    <small>Sélectionnez le compte bancaire à partir duquel vous souhaitez transférer des fonds.</small>


    <label for="note">description de Virement (Facultatif)</label>
    <textarea id="note" name="description" rows="3" placeholder="Fournissez toute information ou instruction supplémentaire liée au virement."></textarea>

    <label for="email">Nom complet de Destinataire</label>
    <input type="text" name="nom_complete" id="email" placeholder="Saisir le nom complet de destinataire" required>

    <label for="receiver-id">Numero de carte bancaire de Destinataire</label>
    <input type="text" name="num_compte_destinataire" id="receiver-id" placeholder="Saisir le numéro de compte public" required>

    <label for="amount">Montant</label>
    <input type="number" name="montant" id="amount" step="0.01" placeholder="ex : 5.00" required>

     <button type="submit"  class="btn btn-primary" >Effectuer le Virement</button> 
</form>


<script>
// function submitTransfer() {
//     const source = document.getElementById('source').value;
//     const email = document.getElementById('email').value;
//     const receiverId = document.getElementById('receiver-id').value;
//     const amount = document.getElementById('amount').value;

//     if (!source || !email || !receiverId || !amount) {
//         alert("Please fill all required fields.");
//         return;
//     }

//     alert("Transfer of $" + amount + " to " + email + " is being processed.");
// }
// </script>
@endsection
