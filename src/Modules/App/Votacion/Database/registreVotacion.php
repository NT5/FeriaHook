<?php

namespace NT5\Bulker\Modules\App\Votacion\Database;

use NT5\Bulker\Modules\App\Votacion\VotacionEntry;
use NT5\Bulker\Modules\Extended;

/**
 * 
 */
trait registreVotacion {

    /**
     * @return Extended
     */
    public abstract function Extended();

    /**
     * 
     * @param int $proyecto_id
     * @param int $user_id
     * @return VotacionEntry[]
     */
    public abstract function getVotacionFromProyectoAndUserId(int $proyecto_id, int $user_id);

    /**
     * @return VotacionEntry
     */
    public abstract function getVotacionFromId(int $id);

    /**
     * 
     * @param int $IdProyecto
     * @param int $IdUser
     * @param int $Documento_Score1
     * @param int $Documento_Score2
     * @param int $Documento_Score3
     * @param int $Documento_Score4
     * @param int $Pertinencia_Score1
     * @param int $Pertinencia_Score2
     * @param int $Pertinencia_Score3
     * @param int $Pertinencia_Score4
     * @param int $Creatividad_Innovacion_Score1
     * @param int $Creatividad_Innovacion_Score2
     * @return VotacionEntry
     */
    public function registreVotacion(int $IdProyecto, int $IdUser, int $Documento_Score1, int $Documento_Score2, int $Documento_Score3, int $Documento_Score4, int $Pertinencia_Score1, int $Pertinencia_Score2, int $Pertinencia_Score3, int $Pertinencia_Score4, int $Creatividad_Innovacion_Score1, int $Creatividad_Innovacion_Score2) {

        $db = $this->Extended()->Database();
        $Proyecto = $this->getVotacionFromProyectoAndUserId($IdProyecto, $IdUser);

        if ($Proyecto->getIdVoto() === 0) {
            $SQL = "INSERT INTO Votacion ("
                    . "IdProyecto, "
                    . "IdUser, "
                    . "Documento_Score1, "
                    . "Documento_Score2, "
                    . "Documento_Score3, "
                    . "Documento_Score4, "
                    . "Pertinencia_Score1, "
                    . "Pertinencia_Score2, "
                    . "Pertinencia_Score3, "
                    . "Pertinencia_Score4, "
                    . "Creatividad_Innovacion_Score1, "
                    . "Creatividad_Innovacion_Score2"
                    . ") "
                    . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($SQL);
            $stmt->bind_param('iiiiiiiiiiii',
                    $IdProyecto,
                    $IdUser,
                    $Documento_Score1,
                    $Documento_Score2,
                    $Documento_Score3,
                    $Documento_Score4,
                    $Pertinencia_Score1,
                    $Pertinencia_Score2,
                    $Pertinencia_Score3,
                    $Pertinencia_Score4,
                    $Creatividad_Innovacion_Score1,
                    $Creatividad_Innovacion_Score2
            );

            $stmt->execute();
            if ($stmt->errno) {
                return new VotacionEntry();
            } else {
                $id = $db->getLastId();
                return $this->getVotacionFromId($id);
            }
        } else {
            $SQL = "UPDATE Votacion SET "
                    . "Documento_Score1 = ?, "
                    . "Documento_Score2 = ?, "
                    . "Documento_Score3 = ?, "
                    . "Documento_Score4 = ?, "
                    . "Pertinencia_Score1 = ?, "
                    . "Pertinencia_Score2 = ?, "
                    . "Pertinencia_Score3 = ?, "
                    . "Pertinencia_Score4 = ?, "
                    . "Creatividad_Innovacion_Score1 = ?, "
                    . "Creatividad_Innovacion_Score2 = ? "
                    . "WHERE IdVoto = ?";

            $IdVoto = $Proyecto->getIdVoto();

            $stmt = $db->prepare($SQL);
            $stmt->bind_param('iiiiiiiiiii',
                    $Documento_Score1,
                    $Documento_Score2,
                    $Documento_Score3,
                    $Documento_Score4,
                    $Pertinencia_Score1,
                    $Pertinencia_Score2,
                    $Pertinencia_Score3,
                    $Pertinencia_Score4,
                    $Creatividad_Innovacion_Score1,
                    $Creatividad_Innovacion_Score2,
                    $IdVoto
            );
            $stmt->execute();
            if ($stmt->errno) {
                return new VotacionEntry();
            } else {
                $id = $IdVoto;
                return $this->getVotacionFromId($id);
            }
        }
        return new VotacionEntry();
    }

}
