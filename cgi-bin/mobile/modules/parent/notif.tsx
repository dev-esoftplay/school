// withHooks

import React from 'react';
import { FlatList, Text, View } from 'react-native';


export interface ParentNotifArgs {
  
}
export interface ParentNotifProps {
  
}
export default function m(props: ParentNotifProps): any {
  const notif = [
    {
      "tittle": "Rapat Guru",
      "message": "Selamat pagi Bapa/Ibu Guru. Hari ini ada rapat guru di ruang guru. Terima kasih.",
      "status": "Pengumuman",
    },
    {
      "tittle": "Gibran Rakabuming Raka",
      "message": "Selamat pagi, Pak. Saya izin tidak masuk sekolah hari ini karena sedang sakit. Terima kasih.",
      "kelas": " | XII IPA 1",
      "status": "ijin Sakit",

    },
    {
      "tittle": "Prabowo Subianto",
      "message": "Selamat pagi, Pak. Saya izin tidak masuk sekolah hari ini karena sedang sakit. Terima kasih.",
      "kelas": " | XII IPA 1",
      "status": "ijin Sakit",

    },
    {
      "tittle": "Muhaimin Iskandar",
      "message": "Selamat pagi, Pak. Saya izin tidak masuk sekolah hari ini kerena ikut pengajian. Terima kasih.",
      "kelas": " |  | XII IPA 1",
      "status": "ijin Sakit",

    },

  ];

  function shadows (value:number) {
    return{
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 1, height: 5 },
      shadowOpacity: 0.7,
      shadowRadius: value,
    }
  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10 }}>
      <Text style={{ fontSize: 24, fontWeight: 'bold' ,marginBottom:30,marginLeft:10}}>Notifikasi</Text>

      <FlatList data={notif}
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item, index }) => {
            return (
              <View style={{ height: 100, backgroundColor: 'white', padding: 10 ,...shadows(7),borderRadius:12,marginHorizontal:10,marginVertical:10}}>
                <View style={{ flexDirection: 'row', marginBottom: 10, justifyContent: 'space-between' }}>
                  <Text style={{ fontSize: 14 }}>{item['tittle']}{item['kelas'] ?? ""}</Text>
                  <View style={{ backgroundColor: 'green', padding: 5, borderRadius: 10, opacity: 0.8, paddingHorizontal: 15 }}>
                    <Text style={{ fontSize: 12, fontWeight: 'bold', color: "white" }}>{item['status']}</Text>
                  </View>
                </View>
                <Text style={{ fontSize: 14 }}>{item['message']}</Text>
              </View>
            )
          }
        }
      />
    </View>
  )
}