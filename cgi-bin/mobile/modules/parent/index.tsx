// withHooks
import { useMemo, useState } from "react";

import React from "react";
import { Pressable, Text, View } from "react-native";
import { IoniconsTypes } from "@expo/vector-icons/build/esoftplay_icons";
import { LibIcon } from "esoftplay/cache/lib/icon/import";
import { LibStyle } from "esoftplay/cache/lib/style/import";
import Home from "./home";
import Notif from "./notif";
import Account from "./account";

export interface ParentIndexArgs {}
export interface ParentIndexProps {}
function m(props: ParentIndexProps): any {
  const [menu, setMenu] = useState("Beranda");

  const [focused, setFocused] = useState(0);

  // Fungsi untuk merender konten berdasarkan nilai menu
  const renderContent = useMemo(() => {
    switch (menu) {
      case "Beranda":
        return <Home />;
      case "Notif":
        return <Notif />;
      case "Akun":
        return <Account />;
      default:
        return <Home />;
    }
  }, [menu]);

  // Fungsi untuk merender satu item menu
  const renderMenuItem = (
    iconName: IoniconsTypes,
    label: string,
    index: number,
    iconNameOutline: IoniconsTypes,
    setpage: number
  ) => (
    <Pressable
      key={index}
      onPress={() => {
        setMenu(label);
        setFocused(setpage);
        console.log("setmenu", label);
      }}
      style={{
        width: 55,
        backgroundColor: "white",
        marginHorizontal: 10,
        alignItems: "center",
      }}
    >
      <View style={{ alignItems: "center" }}>
        {/* Menggunakan ikon dari LibIcon.Ionicons */}
        <LibIcon.Ionicons
          name={focused === index ? iconName : `${iconNameOutline}`}
          size={24}
          // Warna ikon berubah berdasarkan apakah menu difokuskan atau tidak
          color={index === focused ? "#3F8DFD" : "#bfbfbf"}
        />
        {/* Label menu dengan styling tertentu */}
        <Text
          style={{
            fontSize: 12,
            fontWeight: "bold",
            marginBottom: 0,
            marginVertical: 5,
            color: index === focused ? "#3F8DFD" : "#bfbfbf",
          }}
        >
          {label}
        </Text>
      </View>
    </Pressable>
  );

  // Render komponen utama
  return (
    <View style={{ flex: 1, backgroundColor: "white" }}>
      {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000', textAlign: 'center', marginTop: 20 }}>Selamat Datang, {menu}</Text>
      <Text style={{ fontSize: 15, color: '#000000', textAlign: 'center', marginBottom: 20 }}>{focused}</Text> */}

      {renderContent}

      <View
        style={{
          height: 80,
          borderTopLeftRadius: 20,
          borderTopRightRadius: 20,
          paddingVertical: 10,
          backgroundColor: "#ffffff",
          width: LibStyle.width,
          flexDirection: "row",
          justifyContent: "space-around",
        }}
      >
        {/* Render item-menu untuk setiap layar */}
        {renderMenuItem("home", "Beranda", 0, "home-outline", 0)}
        {/* {renderMenuItem("newspaper", "Raport", 1, "newspaper-outline", 1)} */}
        {renderMenuItem("mail", "Notif", 3, "mail-outline", 3)}
        {renderMenuItem("person", "Akun", 4, "person-outline", 4)}
      </View>
    </View>
  );
}
export default m;
