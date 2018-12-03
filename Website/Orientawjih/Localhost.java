package ma.me.amirez.orientawjih;

import java.util.Date;

/**
 * Created by HP on 27/04/2017.
 */

public class Localhost {
    boolean connected=false;
    boolean connect()
    {
        try{
            connected=true;
        }
        catch (Exception ex){
            connected=false;
        }
        return connected;
    }
    boolean disconnect()
    {
        try{
            connected=false;
        }
        catch (Exception ex){
            connected=true;
        }
        return connected;
    }
    boolean addUser(Etudiant etd)
    {
        return true;
    }
    boolean updateUser(Etudiant etd,int position)
    {
        return true;
    }
    boolean removeUser()
    {
        return true;
    }
    Etudiant getUser(int p)
    {
        return  new Etudiant(0,"","","",new Date());
    }
    Etudiant getUser(String tel)
    {
        return  new Etudiant(0,"","","",new Date());
    }
    boolean isTherAnyNewChoices()
    {
        return true;
    }
    Choix[] getNewChoices()
    {
        return  new Choix[10];
    }
}
