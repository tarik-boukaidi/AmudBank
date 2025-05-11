@extends('client')

@section('content') 
    <div id="accounts" class="tab-content">
                @if (session('success'))
                    <div id="flash-message" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <h2 class="section-title"><i class="fas fa-wallet"></i> My Accounts</h2>
                    <div class="account-summary">
                           @foreach($comptes as $compte)

                        <div class="account-card">
                
                            <p class="account-type">Compte {{$compte->type_compte}}</p>
                            <h3 class="account-balance">{{$compte->solde}} DH</h3>
                            <p class="account-number">{{$compte->numero_carte}} </p>
                            <div class="account-actions">
                                <button class="btn btn-sm btn-outline"><i class="fas fa-exchange-alt"></i> Transfer</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-history"></i> History</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-ellipsis-h"></i> More</button>
                            </div>

                        </div>

                        @endforeach

                    </div>
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Open New Account</button>
                </div>
                <div id="registrationContainer">
                    <div class="registration-box">
                        <button class="close-btn" id="closeRegistration">&times;</button>
                        <h2><i class="fas fa-plus-circle"></i> Open New Account</h2>
                        
                        <form id="registrationForm" action="{{route('createNewBankAccount')}}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="accountType">Account Type</label>
                                <select name="type_compte" id="accountType" required>
                                    <option value="">Sélectionnez un type de compte</option>
                                    @if(!auth()->user()->comptes()->where('type_compte', 'epargne')->exists())
                                    <option value="epargne">Compte d'épargne</option>
                                    @endif
                                    @if(!auth()->user()->comptes()->where('type_compte', 'professionnel')->exists())
                                    <option value="professionnel">Compte professionnel</option>
                                    @endif
                                </select>
                                    @if(auth()->user()->comptes()->where('type_compte', 'epargne')->exists() && 
                                        auth()->user()->comptes()->where('type_compte', 'professionnel')->exists())
                                        <p style="color: green; margin-top: 10px;" class="text-success mt-2">Vous avez déjà tous nos comptes bancaires !</p>
                                    @endif
                            </div>
                            
                            <div class="form-group">
                                <label>
                                @if(! (auth()->user()->comptes()->where('type_compte', 'epargne')->exists() && 
      auth()->user()->comptes()->where('type_compte', 'professionnel')->exists()))
                                    <input type="checkbox" id="agreeTerms" required>
                                    I agree to the terms and conditions
                                </label>
                                
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-outline" id="cancelRegistration">Cancel</button>
                                <button type="submit" class="btn btn-primary">Open Account</button>
                            </div>
                                @endif
                        </form>
                    </div>
                </div>
<script>
    const openAccountBtn = document.querySelector('.btn-primary[onclick="showRegistration()"]') || 
                      document.querySelector('.btn-primary:has(i.fa-plus)');
const registrationContainer = document.getElementById('registrationContainer');
const closeBtn = document.getElementById('closeRegistration');
const cancelBtn = document.getElementById('cancelRegistration');
const registrationForm = document.getElementById('registrationForm');

// Fonction pour afficher le formulaire
function showRegistration() {
    registrationContainer.style.display = 'flex';
    setTimeout(() => {
        registrationContainer.style.opacity = '1';
        registrationContainer.querySelector('.registration-box').style.transform = 'translateY(0)';
    }, 10);
}

// Fonction pour masquer le formulaire
function hideRegistration() {
    const box = registrationContainer.querySelector('.registration-box');
    box.style.transform = 'translateY(-20px)';
    registrationContainer.style.opacity = '0';
    
    setTimeout(() => {
        registrationContainer.style.display = 'none';
        registrationForm.reset(); // Réinitialiser le formulaire
    }, 300);
}

// Événements
if (openAccountBtn) {
    openAccountBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showRegistration();
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', hideRegistration);
}

if (cancelBtn) {
    cancelBtn.addEventListener('click', hideRegistration);
}

// Fermer en cliquant à l'extérieur de la boîte
registrationContainer.addEventListener('click', (e) => {
    if (e.target === registrationContainer) {
        hideRegistration();
    }
});

// Empêcher la fermeture quand on clique dans la boîte
registrationContainer.querySelector('.registration-box').addEventListener('click', (e) => {
    e.stopPropagation();
});

// Gestion de la soumission du formulaire
if (registrationForm) {
    registrationForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Ici vous pouvez ajouter votre logique de soumission
        // Par exemple une requête AJAX
        
        // Simulation de succès
        console.log('Formulaire soumis avec succès');
        hideRegistration();
        

    });
}
// Ajoutez ce code temporairement dans votre fichier JS principal
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Form submitted!'); // Vérifiez dans la console F12
    this.submit(); // Envoyer le formulaire manuellement
});
  window.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => {
                    flash.style.display = 'none';
                }, 500); // attendre la fin de la transition
            }, 3000); // 3 secondes d'affichage
        }
    });

// Intégration avec les onglets existants (si nécessaire)
document.querySelectorAll('[data-tab]').forEach(tab => {
    tab.addEventListener('click', (e) => {
        e.preventDefault();
        // Masquer le formulaire si un onglet est cliqué
        if (registrationContainer.style.display === 'flex') {
            hideRegistration();
        }
    });
});
</script>
@endsection