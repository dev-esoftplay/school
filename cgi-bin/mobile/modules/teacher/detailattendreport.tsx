// withHooks
import { useEffect } from 'react';

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React from 'react';
import { FlatList, Platform, Pressable, Text, View } from 'react-native';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';


export interface DetailAttendReportArgs {

}
export interface DetailAttendReportProps {

}
export default function m(props: DetailAttendReportProps): any {
  const data: any = LibNavigation.getArgsAll(props).data;
  const idstudent: string = LibNavigation.getArgsAll(props).idstudent;
  const [resApi, setResApi] = useSafeState<any>([])
  const Absensi = [

    {
      'nama kelas': 'XII IPA 1',
      'jam': '07.00-08.00',
      'jamke': 'jam ke 1 -jam ke 2',
      'jumlah siswa': '30/30',
      'materi': 'Matematika',
      'color': 'green'
    },
    {
      'nama kelas': 'XII IPA 2',
      'jam': '08.00-09.00',
      'jamke': 'jam ke 3 -jam ke 4',
      'materi': 'Fisika',
      'jumlah siswa': '00/30',
      'color': 'red'
    },
    {
      'nama kelas': 'XII IPA 3',
      'jam': '09.00-10.00',
      'jamke': 'jam ke 5 -jam ke 6',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    },
    {
      'nama kelas': 'XII IPA 4',
      'jam': '10.00-11.00',
      'jamke': 'jam ke 7 -jam ke 8',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    },
    {
      'nama kelas': 'XII IPA 5',
      'jam': '11.00-12.00',
      'jamke': 'jam ke 9 -jam ke 10',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    }

  ]
  function elevation(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: "black", shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
    }
    return { elevation: value };
  }
  function shadows(value: number) {
    return {
      elevation: 3, // For Android
      shadowColor: 'black', // For iOS
      shadowOffset: { width: 2, height: 5 },
      shadowOpacity: 0.9,
      shadowRadius: value,
    }
  }

  useEffect(() => {
    // console.log(data.created_date)
    // console.log('idstudent',idstudent)
    // console.log('student_detail_schedule_attendance?student_id='+idstudent+'&date='+data.created_date)
    new LibCurl('student_detail_schedule_attendance?student_id=' + idstudent + '&date=' + data.created_date, get, (result, msg) => {

      // console.log(result)
      setResApi(result)

    }, err => { console.log(err) })
  }, [])
  return (
    <View style={{ flex: 1, backgroundColor: 'white', }}>

      <FlatList data={resApi}
        style={{ height: 'auto', paddingHorizontal: 20 }}
        showsVerticalScrollIndicator={false}
        ListHeaderComponent={

          <View style={{ marginBottom: 20, flexDirection: 'row' }}>
            {/* schadule */}
            <Pressable onPress={() => LibNavigation.back()} style={{ flexDirection: 'row', marginTop: LibStyle.STATUSBAR_HEIGHT + 15 }}>
              <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
              <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', }}>Laporan Absensi</Text>
            </Pressable>

          </View>

        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item, index }) => {

            return (

              <View style={{ backgroundColor: '#0DBD5E', padding: 10, width: '100%', paddingHorizontal: 20, borderRadius: 15, opacity: 0.8, ...shadows(3), marginVertical: 10 }}>

                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.mapel}</Text>
                  <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: 'gray', justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>
                    <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.teacher_name}</Text>
                  </View>
                </View>

                <View style={{ height: 30, }} />
                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.clock_start}</Text>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.clock_end}</Text>
                </View>
              </View>

            )
          }
        } />


    </View>
  )
}