package ma.me.amirez.orientawjih;

import java.sql.Time;
import java.util.Date;

/**
 * Created by HP on 26/04/2017.
 */

public class Notification {
    Choix choix;
    int nbr_e,nbr_c,nbr_b;
    Date date;

    public Notification(Choix choix, int nbr_e, int nbr_c, int nbr_b, Date date) {
        this.choix = choix;
        this.nbr_e = nbr_e;
        this.nbr_c = nbr_c;
        this.nbr_b = nbr_b;
        this.date = date;
    }
}
