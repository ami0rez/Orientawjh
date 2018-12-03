package ma.me.amirez.orientawjih;

import java.util.Date;

/**
 * Created by HP on 26/04/2017.
 */

public class Etudiant {
    private int id;
    private String nom,prenom,tel;
    private Date date;

    public Etudiant(int id, String nom, String prenom, String tel, Date date) {
        this.id = id;
        this.nom = nom;
        this.prenom = prenom;
        this.tel = tel;
        this.date = date;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public void setTel(String tel) {
        this.tel = tel;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public int getId() {
        return id;
    }

    public String getNom() {
        return nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public String getTel() {
        return tel;
    }

    public Date getDate() {
        return date;
    }
}
