<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626063131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_fournisseur_id INTEGER NOT NULL, dateachat DATETIME NOT NULL, numfacture NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , tva NUMERIC(10, 0) DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, CONSTRAINT FK_26A984565A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_26A984565A6AC879 ON achat (id_fournisseur_id)');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone NUMERIC(10, 0) NOT NULL)');
        $this->addSql('CREATE TABLE commande (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_ville_id INTEGER NOT NULL, id_client_id INTEGER NOT NULL, datecommande DATETIME NOT NULL, numfacture NUMERIC(10, 0) NOT NULL, tva NUMERIC(10, 0) DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, etatcommande BOOLEAN NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_6EEAA67DF7E4ECA3 FOREIGN KEY (id_ville_id) REFERENCES ville (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DF7E4ECA3 ON commande (id_ville_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D99DED506 ON commande (id_client_id)');
        $this->addSql('CREATE TABLE detail_achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference_id INTEGER NOT NULL, id_achat_id INTEGER NOT NULL, quantite NUMERIC(10, 0) NOT NULL, prixunitaire NUMERIC(10, 2) NOT NULL, CONSTRAINT FK_5B594F0F1645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5B594F0FAE4E3D82 FOREIGN KEY (id_achat_id) REFERENCES achat (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5B594F0F1645DEA9 ON detail_achat (reference_id)');
        $this->addSql('CREATE INDEX IDX_5B594F0FAE4E3D82 ON detail_achat (id_achat_id)');
        $this->addSql('CREATE TABLE detail_commande (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference_id INTEGER NOT NULL, id_commande_id INTEGER NOT NULL, quantite NUMERIC(10, 0) NOT NULL, prixunitairevente NUMERIC(10, 2) NOT NULL, CONSTRAINT FK_98344FA61645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_98344FA69AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_98344FA61645DEA9 ON detail_commande (reference_id)');
        $this->addSql('CREATE INDEX IDX_98344FA69AF8E3A3 ON detail_commande (id_commande_id)');
        $this->addSql('CREATE TABLE detail_vente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference_id INTEGER NOT NULL, id_vente_id INTEGER NOT NULL, quantite NUMERIC(10, 0) NOT NULL, prixunitairevente NUMERIC(10, 2) NOT NULL, CONSTRAINT FK_F57AE1151645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F57AE1152D1CFB9F FOREIGN KEY (id_vente_id) REFERENCES vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F57AE1151645DEA9 ON detail_vente (reference_id)');
        $this->addSql('CREATE INDEX IDX_F57AE1152D1CFB9F ON detail_vente (id_vente_id)');
        $this->addSql('CREATE TABLE emplacement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE event_user (event_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(event_id, user_id), CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_92589AE271F7E88B ON event_user (event_id)');
        $this->addSql('CREATE INDEX IDX_92589AE2A76ED395 ON event_user (user_id)');
        $this->addSql('CREATE TABLE fournisseur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone NUMERIC(10, 0) NOT NULL)');
        $this->addSql('CREATE TABLE inventaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference_id INTEGER NOT NULL, update_at DATETIME NOT NULL, note VARCHAR(255) NOT NULL, stockinventaire NUMERIC(10, 0) NOT NULL, stockutiliser NUMERIC(10, 0) NOT NULL, CONSTRAINT FK_338920E01645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_338920E01645DEA9 ON inventaire (reference_id)');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_categorie_id INTEGER NOT NULL, emplacement_id INTEGER NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prixunitaire NUMERIC(10, 2) NOT NULL, dateexp DATETIME NOT NULL, qttemin NUMERIC(10, 0) NOT NULL, qttemax NUMERIC(10, 0) NOT NULL, capaciter VARCHAR(255) NOT NULL, unite VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, prixunitairevente NUMERIC(10, 2) NOT NULL, reference_produit VARCHAR(50) DEFAULT NULL, CONSTRAINT FK_29A5EC279F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_29A5EC27C4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_29A5EC279F34925F ON produit (id_categorie_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27C4598A51 ON produit (emplacement_id)');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, pseudo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE vente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_client_id INTEGER NOT NULL, datevente DATETIME NOT NULL, numfacture NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , tva NUMERIC(10, 0) DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, CONSTRAINT FK_888A2A4C99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_888A2A4C99DED506 ON vente (id_client_id)');
        $this->addSql('CREATE TABLE ville (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail_achat');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE detail_vente');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
