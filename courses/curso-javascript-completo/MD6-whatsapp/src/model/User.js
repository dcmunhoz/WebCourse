import { Firebase } from './../util/Firebase';
import { ClassEvent } from './../util/ClassEvent';
import { Model } from './Model';
 
export class User extends Model{

    constructor (id) {

        super();

        if (id) this.getById(id);

        // let userRef = User.findByEmail(response.user.email);

        // userRef.set({
        //     name: response.user.displayName,
        //     email: response.user.email,
        //     photo: response.user.photoURL
        // }).then(()=>{
            
            

        // });

    }

    get name() { return this._data.name };
    set name(val) { this._data.name = val };
    
    get email() { return this._data.email };
    set email(val) { this._data.email = val };
    
    get photo() { return this._data.photo };
    set photo(val) { this._data.photo = val };

    getById(id) {
        return new Promise((s, f)=>{

            // Dados alterando ao vivo
            User.findByEmail(id).onSnapshot(doc=>{
                this.fromJSON(doc.data());

                s(doc);
            });

            // Dado executado uma ves
            // User.findByEmail(id).get().then(doc=>{

            //     this.fromJSON(doc.data());

            //     s(doc);

            // });

        });
    }

    save() {

        return User.findByEmail(this.email).set(this.toJSON());

    }

    static getRef() {

        return Firebase.db().collection('/users')

    }

    static findByEmail (email) {

        return User.getRef().doc(email);


    }

}