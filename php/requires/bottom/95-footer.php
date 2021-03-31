

<!-- ***** 95-FOOTER.PHP : START ***** -->

<?php
// echo'</br> - Chargement (include) du    FOOTer.PHP...';
?>


<footer class="d-flex flex-column">
    <style type="text/css">
        footer{
			position:fixed;
			bottom:-0.75em;
			width:100%;
			z-index: 1;
			/**/
			text-align:center;
            background-color:grey;
        }
        footer > p{
            color:white;
			font-style:italic;
        }
    </style>

	<!-- Incorporation du Javascript spécifiques à cette section du HTML,
	pour éviter les dissociation/désactivation de l'utilisateur : -->
    <script type="text/javascript">
    </script>
    <p>
		<?php
			echo"© Mars 2021 - Ce projet est un examen d'évaluation produit par Hervé BIROLINI (PHP / SQL)";
		?>
	</p>

</footer>

<!-- ***** 95-FOOTER.PHP : END ***** -->