import React, { useState } from 'react';
import { View, TextInput, FlatList, Text, StyleSheet, Image, TouchableOpacity } from 'react-native';
import Icon from 'react-native-vector-icons/Feather';

const data = [
    { id: '1', title: 'Evenements 1', image: 'https://via.placeholder.com/100' },
    { id: '2', title: 'Evenements 2', image: 'https://via.placeholder.com/100' },
    { id: '3', title: 'Evenements 3', image: 'https://via.placeholder.com/100' },
    { id: '4', title: 'Evenements 4', image: 'https://via.placeholder.com/100' },
    { id: '5', title: 'Evenements 5', image: 'https://via.placeholder.com/100' },
    { id: '6', title: 'Evenements 6', image: 'https://via.placeholder.com/100' },
    { id: '7', title: 'Evenements 7', image: 'https://via.placeholder.com/100' },
    { id: '8', title: 'Evenements 8', image: 'https://via.placeholder.com/100' },
];

const additionalCards = [
    { id: '9', title: 'Pharmacie de garde', image: 'https://via.placeholder.com/100' },
    { id: '10', title: 'Hopitale la plus proche', image: 'https://via.placeholder.com/100' },
    { id: '11', title: 'Prix ordonnace', image: 'https://via.placeholder.com/100' },
    { id: '12', title: 'Demande aide medicale', image: 'https://via.placeholder.com/100' },
];

export default function SearchWithCards() {
    const [searchText, setSearchText] = useState('');

    return (
        <View style={styles.container}>
            {/* En-tête avec photo de l'utilisateur et icône des paramètres */}
            <View style={styles.header}>
                <Image
                    source={{ uri: "https://www.institutmontaigne.org/ressources/images/Portraits/Babacar_Ndiaye.jpg" }} // Remplacez par l'URL de la photo de l'utilisateur
                    style={styles.userPhoto}
                />

            </View>

            {/* Barre de recherche */}
            <View style={styles.searchContainer}>
                <Icon name="search" size={20} color="#888" style={styles.icon} />
                <TextInput
                    style={styles.searchInput}
                    placeholder="Rechercher..."
                    value={searchText}
                    onChangeText={setSearchText}
                />
            </View>

            {/* Liste de cards défilantes pour les recettes */}
            <View>
                <Text style={styles.Events}>Evenements</Text>
            </View>
            <FlatList
                data={data}
                horizontal
                keyExtractor={(item) => item.id}
                showsHorizontalScrollIndicator={false}
                renderItem={({ item }) => (
                    <View style={styles.card}>
                        <Image source={{ uri: item.image }} style={styles.image} />
                        <Text style={styles.cardText}>{item.title}</Text>
                    </View>
                )}
            />

            {/* Grille de 4 cartes fixes (2x2) */}
            <View>
                <Text style={styles.Events}>Catégories</Text>
            </View>
            <View style={styles.grid}>
                {additionalCards.map((item) => (
                    <View key={item.id} style={styles.additionalCard}>
                        <Image source={{ uri: item.image }} style={styles.image} />
                        <Text style={styles.cardText}>{item.title}</Text>
                    </View>
                ))}
            </View>
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        padding: 16,
        backgroundColor: '#fff',
        flex: 1,
    },
    header: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
        marginBottom: 16,
    },
    Events: {
        fontSize: 18,
        color: '#38B674',
        fontWeight: "bold",
    },
    userPhoto: {
        width: 40,
        height: 40,
        borderRadius: 20,
    },
    searchContainer: {
        flexDirection: 'row',
        alignItems: 'center',
        borderColor: '#ccc',
        borderWidth: 1,
        borderRadius: 8,
        paddingHorizontal: 10,
        height: 40,
        backgroundColor: '#fff',
        marginBottom: 16,
    },
    icon: {
        marginRight: 8,
    },
    searchInput: {
        flex: 1,
        height: '100%',
    },
    card: {
        backgroundColor: '#38B674',
        padding: 10,
        borderRadius: 8,
        alignItems: 'center',
        marginRight: 10,
        width: 355,
    },
    image: {
        width: 80,
        height: 80,
        borderRadius: 8,
    },
    cardText: {
        marginTop: 5,
        fontSize: 14,
        fontWeight: 'bold',
    },
    grid: {
        flexDirection: 'row',
        flexWrap: 'wrap',
        justifyContent: 'space-between',
        marginTop: 20,
    },
    additionalCard: {
        width: '48%',
        backgroundColor: '#FFA500',
        padding: 10,
        borderRadius: 8,
        alignItems: 'center',
        marginBottom: 10,
    },
});
