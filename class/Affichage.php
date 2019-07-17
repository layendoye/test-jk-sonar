<?php
    class Affichage{
        public static function bouton($donnees,$pages,$title='',$trite_Get,$class_but='',$nom_But,$blank=false){
            $tab=[];
            $target='';
            if($blank) $target=' target="_blank" ';
            for($i=0;$i<count($donnees);$i++){
                foreach($donnees[$i] as $value)
                    $tab[]='<a class="nonSoulign"'.$target.'href="'.$pages.'?title='.$title.'&'.$trite_Get.'='.$value.'" ><button class="'.$class_but.'">'.$nom_But.'</button></a>';
            }
            return $tab;
        }
        public static function selectChambre($name,$class,$id_bat='',$selectCh='',$disabled=false){
            $Ch=EtudiantService::find('Chambres','*','id_Batiment',$id_bat);
            echo '<select name="'.$name.'" class="'.$class.'" '; if($disabled==true){echo' disabled '; }echo'>';
                    for($b=0;$b<count($Ch);$b++){
                        $numeroCh=$Ch[$b]->Numero_Ch;
                        $idCh=$Ch[$b]->id_Chambre;
                        if($selectCh==$idCh)
                            echo'<option value="'.$idCh.'" selected>Chambre '.$numeroCh.'</option>';
                        else
                            echo'<option value="'.$idCh.'">Chambre '.$numeroCh.'</option>';
                    }
            echo'</select>';
        }
        public static function selectBat($name,$class,$selectBat='',$disabled=false){
            $tab_bat=EtudiantService::find('Batiment','*');
            echo '<select name="'.$name.'" id="leBatiment" class="'.$class.'" onchange="this.form.submit();" '; if($disabled==true){echo' disabled '; }echo'>';
            echo'<option value=""></option>';
            for($a=0;$a<count($tab_bat);$a++){
                $bat=$tab_bat[$a]->Nom_bat;
                $id_bat=$tab_bat[$a]->id_Batiment;
                if($selectBat==$id_bat)
                    echo'<option value="'.$id_batid_bat.'" selected>'.$bat.'</option>';
                else
                    echo'<option value="'.$id_bat.'">'.$bat.'</option>';
            }
            echo'</select>';
        }
        public static function statut_etu($matricule){
                $statut=EtudiantService::checkStatut($matricule);
                if($statut['Boursier']==true && $statut['Loge']==true){
                    $value='Loger';
                }
                elseif($statut['Boursier']==true && $statut['Loge']==false){
                    $value='Boursier';
                }
                elseif($statut['Boursier']==false && $statut['Loge']==false){
                    $value='Non Boursier';
                }
            return $value;
        }       
        public static function nmbr_et_ch($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_ch=$donnees[$i]->id_Chambre;
                $tab[]=count(EtudiantService::find('Loges','id_Chambre','id_Chambre',$id_ch));
            }
            return $tab;
        }
        public static function nmbr_et_Bourse($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_categ_bourse=$donnees[$i]->id_Categ_Bourse;
                $tab[]=count(EtudiantService::find('Boursiers','id_Categ_Bourse','id_Categ_Bourse',$id_categ_bourse));
            }
            return $tab;
        }
        public static function chambres($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $Numero_Ch=$donnees[$i]->Numero_Ch;
                $tab[$i][]='Chambre '.$Numero_Ch;
            }
            return $tab;
        }
        public static function Bat_chambres($donnees){
             $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_bat=$donnees[$i]->id_Batiment;
                $tab[]=EtudiantService::find('Batiment','Nom_bat','id_Batiment',$id_bat)[0]->Nom_bat;
            }
            return $tab;
        }
        public static function Numerotation($donnees){//pour batiment
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $tab[$i][]=$i+1;//pour la boucle foreach de Form tableau
            }
            return $tab;
        }
        public static function nom_bat($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $tab[]=$donnees[$i]->Nom_bat;
            }
            return $tab;
        }
        public static function chambre_bat($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $tab[]=count(EtudiantService::find('Chambres','id_Chambre','id_Batiment',$donnees[$i]->id_Batiment));
            }
            return $tab;
        }
        public static function nmbr_etudiant_Bat($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_bat=$donnees[$i]->id_Batiment;
                $ch=EtudiantService::find('Chambres','id_Chambre','id_Batiment',$id_bat);
                $etu=0;
                for($j=0;$j<count($ch);$j++){
                    $etu+=count(EtudiantService::find('Loges','id_Chambre','id_Chambre',$ch[$j]->id_Chambre));
                }
                $tab[]=$etu;
            }
            return $tab;
        }
        public static function bouton_modif_etudiant($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $statut=self::statut_etu($donnees[$i]->Matricule);
                $tab[]='<a class="" href="etudiants.php?title=Etudiants&matricule_modif='.$donnees[$i]->Matricule.'&Statut_et='.$statut.'" ><button class="btn btn-outline-primary btinf">Modifier</button></a>';
            }
            return $tab;
        }
        public static function statut_etudiant($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $tab[]=self::statut_etu($donnees[$i]->Matricule);
            }
            return $tab;
        }        
    }