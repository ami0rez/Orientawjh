package ma.me.amirez.orientawjih;

import java.util.ArrayList;

/**
 * Created by HP on 26/04/2017.
 */

public class Bourse extends Choix {
    public Bourse(int id, String name, String desc, ArrayList<Condition> conditions, ArrayList<Fillere> filleres, ArrayList<Horizon> horizons, ArrayList<Diplome> diplomes, ArrayList<Lieu> lieus) {
        super(id, name, desc, conditions, filleres, horizons, diplomes, lieus);
    }

    public Bourse(int id, String name, String desc) {
        super(id, name, desc);
    }
}
