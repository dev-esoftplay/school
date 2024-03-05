// withHooks
import { memo } from 'react';

import React from 'react';
import { FlatList, Text, View } from 'react-native';


export interface ParentNotifArgs {
  
}
export interface ParentNotifProps {
  
}
function m(props: ParentNotifProps): any {
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
    <View style={{ flex: 1, backgroundColor: 'white' }}>
      
      <View style={{ flex: 0.3, backgroundColor: '#4B7AD6', justifyContent: 'flex-start', padding: 20, paddingTop: 40, borderBottomRightRadius: 12, borderBottomLeftRadius: 12 }}>
        <Text style={{ fontSize: 20, marginTop: 10, color: '#FFFFFF', justifyContent: 'center', textAlign: 'center'}}>Notifikasi</Text>
      </View>

      <View style={{ marginTop: 15, marginBottom: 10, justifyContent: 'center', alignItems: 'center' }}>
        <Text style={{ fontSize: 14, fontWeight: '500', color:'#000000'}}>Kamis, 4 Januari 2024</Text>
      </View>

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
export default memo(m);