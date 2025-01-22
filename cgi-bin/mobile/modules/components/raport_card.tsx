import React from "react";
import { View, Image, StyleSheet } from "react-native";

const ReportCardImage = () => {
  return (
    <View style={styles.card}>
      <Image
        source={require("/var/www/html/school/cgi-bin/mobile/assets/raport.jpeg")}
        style={styles.image}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  card: {
    backgroundColor: "transparent", // Pastikan background transparan
    borderRadius: 10,
    overflow: "hidden", // Hilangkan area latar belakang putih di luar border radius
    elevation: 5, // Shadow untuk Android
    shadowColor: "#000", // Shadow untuk iOS
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.2,
    shadowRadius: 4,
    marginVertical: 20,
    marginHorizontal: 41,
    alignItems: "center",
    borderColor: "black",
    justifyContent: "center",
  },
  image: {
    width: "100%", // Pastikan gambar mengisi semua area card
    height: 400, // Tentukan tinggi gambar sesuai kebutuhan
  },
});

export default ReportCardImage;
