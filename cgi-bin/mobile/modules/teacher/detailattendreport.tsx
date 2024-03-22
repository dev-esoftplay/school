// withHooks
import { useEffect } from 'react';

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React from 'react';
import { FlatList, Pressable, Text, View } from 'react-native';


export interface DetailAttendReportArgs {

}
export interface DetailAttendReportProps {

}
export default function m(props: DetailAttendReportProps): any {
  const data: any = LibNavigation.getArgsAll(props).data;
  const idstudent: string = LibNavigation.getArgsAll(props).idstudent;
  
  const [resApi, setResApi] = useSafeState<any>([])
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
    new LibCurl('student_detail_schedule_attendance?student_id=' + idstudent + '&date=' + data.created_date, null, (result) => {

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
            <Pressable onPress={() => LibNavigation.back()} style={{ flexDirection: 'row', marginTop: LibStyle.STATUSBAR_HEIGHT}}>
              <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
              <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', }}>Laporan Absensi</Text>
            </Pressable>

          </View>

        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item }) => {

            return (

              <View style={{ backgroundColor: '#0DBD5E', padding: 10, width: '100%', paddingHorizontal: 20, borderRadius: 15, opacity: 0.8, ...shadows(3), marginVertical: 10 }}>

                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.mapel}</Text>
                  <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: 'gray', justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>
                    <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.teacher_name}</Text>
                  </View>
                </View>

                <View style={{ height: 30, }} />
                <View style={{ flexDirection: 'row', justifyContent: 'flex-end' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.clock_start}-{item.clock_end}</Text>
             
                </View>
              </View>

            )
          }
        } />


    </View>
  )
}