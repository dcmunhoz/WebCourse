const firebase = require('firebase');
require('firebase/firestore');

export class Firebase {

    constructor(){

        this._firebaseConfig = {
            apiKey: "AIzaSyAERNTNhtQZMxT0lQiJEcbgWekDg0AKgFk",
            authDomain: "whatsapp-clone-8b980.firebaseapp.com",
            databaseURL: "https://whatsapp-clone-8b980.firebaseio.com",
            projectId: "whatsapp-clone-8b980",
            storageBucket: "whatsapp-clone-8b980.appspot.com",
            messagingSenderId: "504374433415",
            appId: "1:504374433415:web:783f4689ccb1cc3e"
        };

        this.init();

    }

    init(){

        if (!this._initialized) {

            // Initialize Firebase
            firebase.initializeApp(this._firebaseConfig);

            firebase.firestore().settings({
                timestampsInSnapshots: true
            });

            this._initialized = true;

        }

    }

    static db(){

        return firebase.firestore();

    }

    static hd(){
        
        return firebase.storage();

    }

}