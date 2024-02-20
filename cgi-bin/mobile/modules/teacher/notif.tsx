// withHooks
import { LibImage_shadow } from 'esoftplay/cache/lib/image_shadow/import';
import { LibList } from 'esoftplay/cache/lib/list/import';
import { LibSkeleton } from 'esoftplay/cache/lib/skeleton/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { UserNotification } from 'esoftplay/cache/user/notification/import';
import esp from 'esoftplay/esp';

import React from 'react';
import { Text, View } from 'react-native';
import { FlatList } from 'react-native-gesture-handler';
import childdetail from '../parent/childdetail';
import { updateId } from 'expo-updates';


export interface TeacherNotifArgs {

}
export interface TeacherNotifProps {

}
export default function m(props: TeacherNotifProps): any {

  let notifs = UserNotification.state().useSelector(s => s.data);


  esp.log(notifs);
  console.log("notif", notifs);
  console.log("notif", notifs[0]?.updated);

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

  function shadows(value: number) {
    return {
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 1, height: 5 },
      shadowOpacity: 0.7,
      shadowRadius: value,
    }
  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10, marginTop: LibStyle.STATUSBAR_HEIGHT }}>
      <Text style={{ fontSize: 24, fontWeight: 'bold', marginBottom: 30, marginLeft: 10 }}>Notifikasi</Text>

      {/* <FlatList data={notif}
        keyExtractor={(item, index) => index.toString()}
        renderItem={({ item, index }) => {
          return (
            <View style={{ height: 100,  borderRadius: 12, marginHorizontal: 10, marginVertical: 10  }}>

              <LibSkeleton duration={1000} colors={['gray', '#a59797', '#dbd1d1']} reverse={true}>
                <View style={{ height: 100, backgroundColor: 'white', padding: 10, ...shadows(7), borderRadius: 12}} />
              </LibSkeleton>
            </View>
          )
        }
        } /> */}


      <LibList data={notifs}
        keyExtractor={(item, index) => index.toString()}
        renderItem={(item: any, index: number) => {
          console.log("item", item?.title)
          return (
            <View style={{ height: 100, backgroundColor: 'white', padding: 10, ...shadows(7), borderRadius: 12, marginHorizontal: 10, marginVertical: 10 }}>
              <View style={{ flexDirection: 'row', marginBottom: 10, justifyContent: 'space-between' }}>

                <Text style={{ fontSize: 14 }}>{item?.title ?? 'tittle'}</Text>
                <View style={{ backgroundColor: 'green', padding: 5, borderRadius: 10, opacity: 0.8, paddingHorizontal: 15 }}>
                  <Text style={{ fontSize: 12, fontWeight: 'bold', color: "white" }}>{item['status']}</Text>
                </View>
              </View>
              <Text style={{ fontSize: 12, color: 'gray' }}>{item.message}</Text>

              <Text style={{ fontSize: 12, color: 'gray' }}>{item.updated}</Text>

            </View>
          )
        }
        }
      />
    </View>
  )
}