package ma.me.amirez.orientawjih;

import java.util.ArrayList;

/**
 * Created by HP on 26/04/2017.
 */
public class Choix {
    int id;
    String name,desc;
    ArrayList<Condition>conditions;
    ArrayList<Fillere> filleres;
    ArrayList<Horizon>horizons;
    ArrayList<Diplome>diplomes;
    ArrayList<Lieu>lieus;

    public Choix(int id, String name, String desc, ArrayList<Condition> conditions, ArrayList<Fillere> filleres, ArrayList<Horizon> horizons, ArrayList<Diplome> diplomes, ArrayList<Lieu> lieus) {
        this.id = id;
        this.name = name;
        this.desc = desc;
        this.conditions = conditions;
        this.filleres = filleres;
        this.horizons = horizons;
        this.diplomes = diplomes;
        this.lieus = lieus;
    }

    public Choix(int id, String name, String desc) {
        this.id = id;
        this.name = name;
        this.desc = desc;
    }
}
class Fillere{
    int id;
    String name;

    public Fillere(int id, String name) {
        this.id = id;
        this.name = name;
    }
}
class Diplome{
    int id;
    String nom;
    int duree;

    public Diplome(int id, String nom, int duree) {
        this.id = id;
        this.nom = nom;
        this.duree = duree;
    }
}
class Horizon{
    int id;
    String name;
    //don't add diplmoes here cuz we xont have only one horizon
    public Horizon(int id, String name) {
        this.id = id;
        this.name = name;
    }
}
class Condition{
    int age;
    //montion declaree comme enumeration
    int Note_seuile;
    public Condition(int age, int note_seuile, ArrayList<Fillere> filleres) {
        this.age = age;
        Note_seuile = note_seuile;
    }
}
class Lieu{
    int id;
    String name;
    int Long,Latt;
    public Lieu(int id, String name, int aLong, int latt) {
        this.id = id;
        this.name = name;
        Long = aLong;
        Latt = latt;
    }
}
