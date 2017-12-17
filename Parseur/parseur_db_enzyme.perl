#!/usr/bin/perl -w

#Purpose: Ce script nous permet de parser les fichiers des EC numbers
#qui nous servent pour le projet de programmation web.
#la sortie de ce script est un fichier texte avec chacune des valeurs
#des balises et les balises avant et apres ces valeurs. Chaque EC number est numerote.


#Usage: La commande est a executer dans le terminal place dans
#le dossier ou se trouve le script et le fichier a parser
#on execute : perl parseur_fichier1.perl fichier.txt (ce fichier est celui a parser)


open (FICHIER1, ">fichier1.txt") || die ("Vous ne pouvez pas créer le fichier \"fichier.txt\"");
my @res;
my @res2;
#Ce sont les tables des resultats des deux splits

while (<>)
{
  @res=split(/>/,$_);

  foreach (@res)
  {
    if (m/</,$_)
    {
      @res2 = split(/</,$_);

      print FICHIER1 $res2[0];
      print FICHIER1 "\n";
      #Ce bloc entre dans le fichier les valeurs qui sont dans les balises

      print FICHIER1 $res2[1];
      print FICHIER1 "\n";
      #Ce bloc inscrit les balises ouvrantes et fermantes avant et apres la ligne du contenu
    }

  }
  print FICHIER1 "\n";

}

close (FICHIER1);
