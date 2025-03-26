<?php

    /**
     * Protège le système contre les failles de type csrf.
     *
     * @param string $sessionCsrfToken
     * @param string $postCsrfToken
     * @return boolean
     */
    function isCsrfTokenValid(string $sessionCsrfToken, string $postCsrfToken) : bool
    {
        // Si le csrf_token n'existe pas ni dans le formulaire ni en session, fin script
        if( !isset($postCsrfToken) || !isset($sessionCsrfToken))
        {
            return false;
        }

        // Si le csrf_token est vide en session ou dans le formulaire
        if( empty($postCsrfToken) || empty($sessionCsrfToken) )
        {
            return false;
        }

        // Si le csrf_token du formulaire est différent du csrf_token de la session, fin script
        if( $postCsrfToken !== $sessionCsrfToken )
        {
            return false;
        }

        return true;
    }

    /**
     * Protège le système contre les spamers bots
     *
     * @param string $postHoneyPot
     * @return boolean
     */
    function isHoneyPotLicked(string $postHoneyPotValue): bool
    {
        if( $postHoneyPotValue === "" )
        {
            return false;
        }

        return true;
    }

?>